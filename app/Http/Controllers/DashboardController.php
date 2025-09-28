<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\CatatanLembur;
use App\Models\Persetujuan;
use App\Models\Upah;
use App\Models\Departemen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan ringkasan dashboard utama.
     * Menampilkan statistik yang berbeda berdasarkan role user.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil data statistik berdasarkan role user
        $stats = $this->getDashboardStats($user);

        // Ambil data lembur bulanan untuk 12 bulan terakhir
        $monthlyOvertime = $this->getMonthlyOvertimeData($user);

        // Ambil distribusi karyawan per departemen
        $departmentStats = $this->getDepartmentStats();

        // Ambil catatan lembur terbaru
        $recentOvertime = $this->getRecentOvertime($user);

        return view('dashboard.main.index', compact(
            'stats',
            'monthlyOvertime',
            'departmentStats',
            'recentOvertime'
        ));
    }

    /**
     * Mengambil data statistik dashboard berdasarkan role user.
     */
    private function getDashboardStats($user)
    {
        if ($user->hasAnyRole(['Pimpinan', 'HRD'])) {
            return [
                'total_karyawan' => Karyawan::count(),
                'total_catatan_lembur' => CatatanLembur::whereHas('persetujuan', function ($q) {
                    $q->where('status', 'disetujui');
                })->count(),
                'total_persetujuan' => Persetujuan::where('status', 'disetujui')->count(),
                'total_upah' => Upah::sum('jumlah'),
                'persetujuan' => Persetujuan::where('status', 'pending')->count()
            ];
        }

        // Untuk karyawan biasa, hanya tampilkan data pribadi
        return [
            'total_catatan_lembur' => CatatanLembur::where('karyawan_id', $user->karyawan->id)->count(),
            'total_persetujuan' => Persetujuan::where('status', 'disetujui')
                ->whereHas('catatanLembur', function ($q) use ($user) {
                    $q->where('karyawan_id', $user->karyawan->id);
                })->count(),
            'total_upah' => Upah::whereHas('catatanLembur', function ($q) use ($user) {
                $q->where('karyawan_id', $user->karyawan->id);
            })->sum('jumlah'),
        ];
    }

    /**
     * Mengambil data lembur bulanan untuk 12 bulan terakhir.
     */
    private function getMonthlyOvertimeData($user)
    {
        $monthlyOvertime = [];
        $query = CatatanLembur::query();

        // Filter berdasarkan karyawan jika bukan admin
        if (!$user->hasAnyRole(['Pimpinan', 'HRD'])) {
            $query->where('karyawan_id', $user->karyawan->id);
        }

        // Hitung data untuk 12 bulan terakhir
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = (clone $query)->whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->count();
            $monthlyOvertime[] = $count;
        }

        return $monthlyOvertime;
    }

    /**
     * Mengambil statistik distribusi karyawan per departemen.
     */
    private function getDepartmentStats()
    {
        return Departemen::all()->map(function ($dept) {
            return [
                'name' => $dept->name,
                'karyawans_count' => $dept->karyawans()->count(),
            ];
        });
    }

    /**
     * Mengambil catatan lembur terbaru berdasarkan role user.
     */
    private function getRecentOvertime($user)
    {
        $query = CatatanLembur::with(['karyawan.jabatan', 'karyawan.departemen']);

        // Filter berdasarkan karyawan jika bukan admin
        if (!$user->hasAnyRole(['Pimpinan', 'HRD'])) {
            $query->where('karyawan_id', $user->karyawan->id);
        }

        return $query->latest('tanggal')->take(5)->get();
    }
}

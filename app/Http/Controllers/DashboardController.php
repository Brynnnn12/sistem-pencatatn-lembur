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
     * Display the dashboard overview.
     */
    public function index()
    {
        $user = Auth::user();

        // Stats data
        if ($user->hasAnyRole(['Pimpinan', 'HRD'])) {
            $stats = [
                'total_karyawan' => Karyawan::count(),
                'total_catatan_lembur' => CatatanLembur::count(),
                'total_persetujuan' => Persetujuan::count(),
                'total_upah' => Upah::sum('jumlah'),
            ];
        } else {
            $stats = [
                'total_catatan_lembur' => CatatanLembur::where('karyawan_id', $user->karyawan->id)->count(),
                'total_persetujuan' => Persetujuan::whereHas('catatanLembur', function ($q) use ($user) {
                    $q->where('karyawan_id', $user->karyawan->id);
                })->count(),
                'total_upah' => Upah::whereHas('catatanLembur', function ($q) use ($user) {
                    $q->where('karyawan_id', $user->karyawan->id);
                })->sum('jumlah'),
            ];
        }

        // Monthly overtime data for the last 12 months
        $monthlyOvertime = [];
        $query = CatatanLembur::query();
        if (!$user->hasAnyRole(['Pimpinan', 'HRD'])) {
            $query->where('karyawan_id', $user->karyawan->id);
        }
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = (clone $query)->whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->count();
            $monthlyOvertime[] = $count;
        }

        // Department distribution
        $departments = Departemen::all();
        $departmentStats = $departments->map(function ($dept) {
            return [
                'name' => $dept->name,
                'karyawans_count' => $dept->karyawans()->count(),
            ];
        });

        // Recent overtime records
        $user = Auth::user();
        if ($user->hasAnyRole(['Pimpinan', 'HRD'])) {
            $recentOvertime = CatatanLembur::with(['karyawan.jabatan', 'karyawan.departemen'])
                ->latest('tanggal')
                ->take(5)
                ->get();
        } else {
            $recentOvertime = CatatanLembur::with(['karyawan.jabatan', 'karyawan.departemen'])
                ->where('karyawan_id', $user->karyawan->id)
                ->latest('tanggal')
                ->take(5)
                ->get();
        }

        return view('dashboard.main.index', compact(
            'stats',
            'monthlyOvertime',
            'departmentStats',
            'recentOvertime'
        ));
    }
}

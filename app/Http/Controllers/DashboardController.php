<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\CatatanLembur;
use App\Models\Persetujuan;
use App\Models\Upah;
use App\Models\Departemen;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard overview.
     */
    public function index()
    {
        // Stats data
        $stats = [
            'total_karyawan' => Karyawan::count(),
            'total_catatan_lembur' => CatatanLembur::count(),
            'total_persetujuan' => Persetujuan::count(),
            'total_upah' => Upah::sum('jumlah'),
        ];

        // Monthly overtime data for the last 12 months
        $monthlyOvertime = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = CatatanLembur::whereYear('tanggal', $date->year)
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
        $recentOvertime = CatatanLembur::with(['karyawan.jabatan', 'karyawan.departemen'])
            ->latest('tanggal')
            ->take(5)
            ->get();

        return view('dashboard.main.index', compact(
            'stats',
            'monthlyOvertime',
            'departmentStats',
            'recentOvertime'
        ));
    }
}

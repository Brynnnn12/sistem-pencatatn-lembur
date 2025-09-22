<?php

namespace App\Providers;



use App\Models\Upah;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Departemen;
use App\Models\Persetujuan;
use App\Models\CatatanLembur;
use App\Policies\UpahPolicy;
use App\Policies\JabatanPolicy;
use App\Policies\KaryawanPolicy;
use App\Policies\DepartemenPolicy;
use App\Policies\PersetujuanPolicy;
use App\Policies\CatatanLemburPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Jabatan::class => JabatanPolicy::class,
        Departemen::class => DepartemenPolicy::class,
        Karyawan::class => KaryawanPolicy::class,
        Persetujuan::class => PersetujuanPolicy::class,
        Upah::class => UpahPolicy::class,
        CatatanLembur::class => CatatanLemburPolicy::class
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}

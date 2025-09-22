<?php

namespace App\Policies;

use App\Models\Persetujuan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PersetujuanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Pimpinan', 'HRD']) || $user->hasRole('Karyawan');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Persetujuan $persetujuan): bool
    {
        // Pimpinan dan HRD bisa melihat semua
        if ($user->hasAnyRole(['Pimpinan', 'HRD'])) {
            return true;
        }

        // Karyawan hanya bisa melihat persetujuan yang terkait dengan catatan lemburnya
        if ($user->hasRole('Karyawan')) {
            return $persetujuan->catatanLembur->karyawan->user_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false; // Persetujuan dibuat otomatis atau oleh sistem, bukan oleh Pimpinan/HRD
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Persetujuan $persetujuan): bool
    {
        return $user->hasAnyRole(['Pimpinan', 'HRD']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Persetujuan $persetujuan): bool
    {
        return $user->hasAnyRole(['Pimpinan', 'HRD']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Persetujuan $persetujuan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Persetujuan $persetujuan): bool
    {
        return false;
    }
}

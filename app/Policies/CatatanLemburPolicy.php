<?php

namespace App\Policies;

use App\Models\CatatanLembur;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CatatanLemburPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Pimpinan', 'HRD', 'Karyawan']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CatatanLembur $catatanLembur): bool
    {
        // Pimpinan dan HRD bisa melihat semua
        if ($user->hasAnyRole(['Pimpinan', 'HRD'])) {
            return true;
        }

        // Karyawan tidak bisa melihat detail catatan lembur
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Karyawan');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CatatanLembur $catatanLembur): bool
    {
        // Karyawan hanya bisa update catatan lemburnya sendiri
        return $user->hasRole('Karyawan') && $catatanLembur->karyawan->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CatatanLembur $catatanLembur): bool
    {
        // Karyawan hanya bisa delete catatan lemburnya sendiri
        return $user->hasRole('Karyawan') && $catatanLembur->karyawan->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CatatanLembur $catatanLembur): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CatatanLembur $catatanLembur): bool
    {
        return false;
    }
}

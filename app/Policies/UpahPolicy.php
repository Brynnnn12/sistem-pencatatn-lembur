<?php

namespace App\Policies;

use App\Models\Upah;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UpahPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Pimpinan', 'HRD']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Upah $upah): bool
    {
        // Pimpinan dan HRD bisa melihat semua
        if ($user->hasAnyRole(['Pimpinan', 'HRD'])) {
            return true;
        }

        // Karyawan tidak bisa melihat upah
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false; // Upah dibuat otomatis saat catatan lembur dibuat
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Upah $upah): bool
    {
        return $user->hasAnyRole(['Pimpinan', 'HRD']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Upah $upah): bool
    {
        return $user->hasAnyRole(['Pimpinan', 'HRD']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Upah $upah): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Upah $upah): bool
    {
        return false;
    }
}

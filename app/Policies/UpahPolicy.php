<?php

namespace App\Policies;

use App\Models\Upah;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UpahPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // HRD dan Pimpinan bisa lihat semua upah
        return $user->hasAnyRole(['Pimpinan', 'HRD']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Upah $upah): bool
    {
        // HRD dan Pimpinan bisa melihat semua
        if ($user->hasAnyRole(['HRD', 'Pimpinan'])) {
            return true;
        }

        // Karyawan hanya bisa melihat upah miliknya sendiri
        if ($user->hasRole('Karyawan') && $user->id === $upah->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Upah dibuat otomatis saat catatan lembur dibuat
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Upah $upah): bool
    {
        // Hanya HRD yang bisa update
        return $user->hasRole('HRD');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Upah $upah): bool
    {
        // Hanya HRD yang bisa delete
        return $user->hasRole('HRD');
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

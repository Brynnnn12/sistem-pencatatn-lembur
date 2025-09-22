<?php

namespace App\Policies;

use App\Models\Departemen;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DepartemenPolicy
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
    public function view(User $user, Departemen $departemen): bool
    {
        return $user->hasAnyRole(['Pimpinan', 'HRD']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Pimpinan', 'HRD']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Departemen $departemen): bool
    {
        return $user->hasAnyRole(['Pimpinan', 'HRD']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Departemen $departemen): bool
    {
        return $user->hasAnyRole(['Pimpinan', 'HRD']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Departemen $departemen): bool
    {
        return $user->hasRole('Pimpinan', 'HRD');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Departemen $departemen): bool
    {
        return $user->hasRole('Pimpinan', 'HRD');
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Copon;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoponPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_copon');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Copon $copon): bool
    {
        return $user->can('view_copon');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_copon');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Copon $copon): bool
    {
        return $user->can('update_copon');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Copon $copon): bool
    {
        return $user->can('delete_copon');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_copon');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Copon $copon): bool
    {
        return $user->can('force_delete_copon');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_copon');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Copon $copon): bool
    {
        return $user->can('restore_copon');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_copon');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Copon $copon): bool
    {
        return $user->can('replicate_copon');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_copon');
    }
}

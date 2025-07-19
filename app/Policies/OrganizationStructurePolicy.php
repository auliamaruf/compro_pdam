<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OrganizationStructure;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationStructurePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_organization::structure');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OrganizationStructure $organizationStructure): bool
    {
        return $user->can('view_organization::structure');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_organization::structure');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OrganizationStructure $organizationStructure): bool
    {
        return $user->can('update_organization::structure');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OrganizationStructure $organizationStructure): bool
    {
        return $user->can('delete_organization::structure');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_organization::structure');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, OrganizationStructure $organizationStructure): bool
    {
        return $user->can('force_delete_organization::structure');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_organization::structure');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, OrganizationStructure $organizationStructure): bool
    {
        return $user->can('restore_organization::structure');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_organization::structure');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, OrganizationStructure $organizationStructure): bool
    {
        return $user->can('replicate_organization::structure');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_organization::structure');
    }
}

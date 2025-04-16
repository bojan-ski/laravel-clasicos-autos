<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\CarListing;
use App\Models\User;

class CarListingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CarListing $listing): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role == 'app_user';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CarListing $listing): bool
    {
        return $user->id == $listing->user_id || $user->role == 'admin_user';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CarListing $listing): bool
    {
        return $user->id == $listing->user_id || $user->role == 'admin_user';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CarListing $listing): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CarListing $listing): bool
    {
        return false;
    }
}

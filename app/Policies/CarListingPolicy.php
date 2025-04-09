<?php

namespace App\Policies;

use App\Models\CarListing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

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
    public function view(User $user, CarListing $carListing): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CarListing $carListing): bool
    {
        return $user->id == $carListing->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CarListing $carListing): bool
    {
        return $user->id == $carListing->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CarListing $carListing): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CarListing $carListing): bool
    {
        return false;
    }
}

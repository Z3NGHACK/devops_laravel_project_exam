<?php

namespace App\Policies;

use App\Models\Terrain;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TerrainPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Terrain $terrain)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->exists;
    }

    public function update(User $user, Terrain $terrain)
    {
        return $user->id === $terrain->owner_id;
    }

    public function delete(User $user, Terrain $terrain)
    {
        return $user->id === $terrain->owner_id;
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Terrain $terrain): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Terrain $terrain): bool
    {
        return false;
    }
}

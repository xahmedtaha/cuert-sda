<?php

namespace App\Policies;

use App\Models\InventoryItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryItemPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, InventoryItem $inventoryItem): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === User::ADMIN_ROLE;
    }

    public function update(User $user, InventoryItem $inventoryItem): bool
    {
        return $user->role === User::ADMIN_ROLE;
    }

    public function delete(User $user, InventoryItem $inventoryItem): bool
    {
        return $user->role === User::ADMIN_ROLE;
    }

    public function restore(User $user, InventoryItem $inventoryItem): bool
    {
        return $user->role === User::ADMIN_ROLE;
    }

    public function forceDelete(User $user, InventoryItem $inventoryItem): bool
    {
        return $user->role === User::ADMIN_ROLE;
    }
}

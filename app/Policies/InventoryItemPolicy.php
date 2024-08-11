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

    }

    public function view(User $user, InventoryItem $inventoryItem): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, InventoryItem $inventoryItem): bool
    {
    }

    public function delete(User $user, InventoryItem $inventoryItem): bool
    {
    }

    public function restore(User $user, InventoryItem $inventoryItem): bool
    {
    }

    public function forceDelete(User $user, InventoryItem $inventoryItem): bool
    {
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryItemRequest;
use App\Http\Resources\InventoryItemResource;
use App\Models\InventoryItem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InventoryItemController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', InventoryItem::class);

        return InventoryItemResource::collection(InventoryItem::all());
    }

    public function store(InventoryItemRequest $request)
    {
        $this->authorize('create', InventoryItem::class);

        return new InventoryItemResource(InventoryItem::create($request->validated()));
    }

    public function show(InventoryItem $inventoryItem)
    {
        $this->authorize('view', $inventoryItem);

        return new InventoryItemResource($inventoryItem);
    }

    public function update(InventoryItemRequest $request, InventoryItem $inventoryItem)
    {
        $this->authorize('update', $inventoryItem);

        $inventoryItem->update($request->validated());

        return new InventoryItemResource($inventoryItem);
    }

    public function destroy(InventoryItem $inventoryItem)
    {
        $this->authorize('delete', $inventoryItem);

        $inventoryItem->delete();

        return response()->json();
    }
}

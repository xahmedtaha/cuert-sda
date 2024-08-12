<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryItemRequest;
use App\Http\Resources\InventoryItemResource;
use App\Models\ElectricalPart;
use App\Models\InventoryItem;
use App\Models\MechanicalPart;
use App\Models\RawMaterial;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InventoryItemController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', InventoryItem::class);

        return Inertia::render('Dashboard', [
            'items' => InventoryItemResource::collection(InventoryItem::all()),
        ]);
    }

    public function store(InventoryItemRequest $request)
    {
        $this->authorize('create', InventoryItem::class);

        $inventoryItem = DB::transaction(function () use ($request) {
            $itemColumns = ['name', 'quantity', 'part_type', 'part_id'];
            $rawMaterialColumns = ['type', 'purity'];
            $electricalPartColumns = ['voltage', 'current', 'power_rating'];
            $mechanicalPartColumns = ['dimensions', 'weight', 'material'];

            $data = $request->toArray();
            $data = match ($data['part_type']) {
                RawMaterial::class => array_merge(
                    Arr::only($data, [...$itemColumns, ...$rawMaterialColumns]),
                    ['part_id' => RawMaterial::create(Arr::only($data, $rawMaterialColumns))->id]
                ),
                ElectricalPart::class => array_merge(
                    Arr::only($data, [...$itemColumns, ...$electricalPartColumns]),
                    ['part_id' => ElectricalPart::create(Arr::only($data, $electricalPartColumns))->id]
                ),
                MechanicalPart::class => array_merge(
                    Arr::only($data, [...$itemColumns, ...$mechanicalPartColumns]),
                    ['part_id' => MechanicalPart::create(Arr::only($data, $mechanicalPartColumns))->id]
                ),
            };
            return InventoryItem::create(Arr::only($data, $itemColumns));
        });
        return to_route('dashboard')->with('message', 'Item created.');
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

        return to_route('dashboard')->with('message', 'Item updated.');
    }

    public function destroy(InventoryItem $inventoryItem)
    {
        $this->authorize('delete', $inventoryItem);

        $inventoryItem->delete();

        return to_route('dashboard')->with('message', 'Item deleted.');
    }
}

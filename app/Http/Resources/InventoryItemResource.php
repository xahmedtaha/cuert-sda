<?php

namespace App\Http\Resources;

use App\Models\ElectricalPart;
use App\Models\InventoryItem;
use App\Models\MechanicalPart;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin InventoryItem */
class InventoryItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'part_type' => match ($this->part_type) {
                MechanicalPart::class => __('Mechanical Part'),
                ElectricalPart::class => __('Electrical Part'),
                RawMaterial::class => __('Raw Material'),
            },
            'type_short' => match ($this->part_type) {
                MechanicalPart::class => __('mechanical'),
                ElectricalPart::class => __('electrical'),
                RawMaterial::class => __('material'),
            },
            'part' => $this->whenLoaded('part'),
            'description' => $this->description,
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class InventoryItem extends Model
{
    protected $with = ['part'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function part(): MorphTo
    {
        return $this->morphTo();
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => match ($attributes['part_type']) {
                MechanicalPart::class => $this->getRelation('part')->only(['material', 'dimensions', 'weight']),
                ElectricalPart::class => $this->getRelation('part')->only(['voltage', 'current', 'power_rating']),
                RawMaterial::class => $this->getRelation('part')->only(['type', 'purity']),
                default => [],
            },
        );
    }
}

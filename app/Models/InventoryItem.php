<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class InventoryItem extends Model
{
    protected $with = ['part'];

    public function part(): MorphTo
    {
        return $this->morphTo();
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => match ($attributes['part_type']) {
                MechanicalPart::class => Arr::mapWithKeys($this->getRelation('part')->only(['material', 'dimensions', 'weight']), fn ($item, $key) => [str($key)->replace('_', ' ')->apa()->toString() => $item]),
                ElectricalPart::class => Arr::mapWithKeys($this->getRelation('part')->only(['voltage', 'current', 'power_rating']), fn ($item, $key) => [str($key)->replace('_', ' ')->apa()->toString() => $item]),
                RawMaterial::class => Arr::mapWithKeys($this->getRelation('part')->only(['type', 'purity']), fn ($item, $key) => [str($key)->replace('_', ' ')->apa()->toString() => $item]),
                default => [],
            },
        );
    }
}

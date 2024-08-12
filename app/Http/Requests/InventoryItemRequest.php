<?php

namespace App\Http\Requests;

use App\Models\ElectricalPart;
use App\Models\MechanicalPart;
use App\Models\RawMaterial;
use Illuminate\Foundation\Http\FormRequest;

class InventoryItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'quantity' => ['nullable', 'integer', 'min:0'],
            'part_type' => ['required', 'string', 'in:material,electrical,mechanical'],

            'material' => ['nullable', 'string', 'max:255', 'required_if:part_type,mechanical'],
            'dimensions' => ['nullable', 'string', 'max:255', 'required_if:part_type,mechanical'],
            'weight' => ['nullable', 'numeric', 'min:0', 'required_if:part_type,mechanical'],

            'type' => ['nullable', 'string', 'max:255', 'required_if:part_type,material'],
            'purity' => ['nullable', 'numeric', 'min:0', 'required_if:part_type,material'],

            'voltage' => ['nullable', 'numeric', 'min:0', 'required_if:part_type,electrical'],
            'current' => ['nullable', 'numeric', 'min:0', 'required_if:part_type,electrical'],
            'power_rating' => ['nullable', 'numeric', 'min:0', 'required_if:part_type,electrical'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'part_type' => match ($this->input('part_type')) {
                'material' => RawMaterial::class,
                'electrical' => ElectricalPart::class,
                'mechanical' => MechanicalPart::class,
            },
        ]);
    }
}

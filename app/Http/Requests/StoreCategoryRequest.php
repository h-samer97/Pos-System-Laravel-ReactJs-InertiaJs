<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return $this->user()->can('manager-category');
    }

    public function rules(): array
    {
        return [
            
            'parent_id' => ['nullable', 'integer', Rule::exists('categories', 'id')->whereNull('deleted_at')],
            'name' => ['string', 'required', 'max:255'],
            'slug' => ['string', 'required', 'max:255', 'alpha_dash', Rule::exists('categories', 'slug')],
            'sort-order' => ['integer', 'min:0', 'nullable'],
            'is_active' => ['boolean']

        ];
    }
}

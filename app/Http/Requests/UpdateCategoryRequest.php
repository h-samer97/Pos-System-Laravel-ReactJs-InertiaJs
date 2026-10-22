<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage-categories');
    }

    public function rules(): array
    {

        $categories = $this->route('category');

        return [
            'parent_id' => ['nullable', 'integer',
                Rule::exists('categories', 'id')->whereNull('deleted_at'),
                Rule::notIn([$categories->id]),
            ],
            'name' => ['string', 'max:255', 'required'],
            'slug' => [
                'string',
                'max:255',
                'required',
                'alpha_dash',
                Rule::unique('categories', 'slug')->ignore($categories->id)->whereNull('deleted_at'),
            ],
            'sort_order' => ['nullable', 'min:0', 'integer'],
            'is_active' => ['boolean']
            
        ];
    }
}

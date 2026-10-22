<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Interfaces\ICategory;
use App\Models\categories;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CategoriesController extends Controller
{

    public function __construct(private readonly ICategory $icategory) {}

    public function index()
    {
        $categories = $this->icategory->tree()
            ->map(fn(Category $category) => $this->present($category));

        return Inertia::render('Categories/Index', [
            'categories' => $categories,
            'url_store' => route('categories.store')
        ]);
    }

    public function create(StoreCategoryRequest $request)
    {
        $this->icategory->create($request->validated());
        return back();
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->icategory->update($category, $request->validated());
        return back();
    }

    public function destroy(Category $category)
    {
        Gate::authorize('manage-categories');
        if ($category->children()->exists()) {
            return back()->withErrors([
                'category' => 'This Category has subcategories and cannot be deleted direcly'
            ]);
        }
        $this->icategory->delete($category);
        return back();
    }

    public function present(Category $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'sort_order' => $category->sort_order,
            'is_active' => $category->is_active,
            'children' => $category->children
                ->map(fn(Category $child) => $this->present($child))
                ->toArray(),
            'urls' => [
                'update' => route('categories.update', $category),
                'destroy' => route('categories.destroy', $category)
            ]
        ];
    }
}

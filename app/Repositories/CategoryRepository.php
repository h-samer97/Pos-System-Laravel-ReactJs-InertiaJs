<?php

  namespace App\Repositories;

use App\Interfaces\ICategory;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Override;

class CategoryRepository implements ICategory {

  public const CACHE_KEY = 'categories.tree';  
  public const CACHE_TTL = 30;  

  public function tree(): Collection
  {
      return Cache::remember(self::CACHE_KEY,
       now()->addMinute(self::CACHE_TTL),
        function () {
          return Category::query()
              ->whereNull('parent_id')
              ->with([
                  'children' => fn ($query) => $query->orderBy('sort_order'),
              ])
              ->orderBy('sort_order')
              ->get();
      });
  }

  #[Override]
  public function create(array $data): Category
  {
    return Category::create($data);
  }
  #[Override]
  public function update(Category $category, array $data): Category
  {
    return Category::update($data);
  }
  #[Override]
  public function delete(Category $category): void
  {
    $category->delete();
  }

}
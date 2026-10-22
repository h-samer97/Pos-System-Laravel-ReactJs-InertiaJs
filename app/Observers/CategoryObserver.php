<?php

namespace App\Observers;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
   public function saved(Category $category) : void {
        Cache::forget(CategoryRepository::CACHE_KEY);
   }

   public function deleted(Category $category) : void {
        Cache::forget(CategoryRepository::CACHE_KEY);
   }
}

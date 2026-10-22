<?php

namespace App\Providers;

use App\Interfaces\ICategory;
use App\Repositories\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ICategory::class, CategoryRepository::class);
    }

    public function boot(): void
    {
        //
    }
}

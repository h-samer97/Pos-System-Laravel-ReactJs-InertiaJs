<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    
    public function register(): void {}

    public function boot(): void
    {
        Gate::define('manage-categories', function(Admin $admin) {
            return true;
        });
    }
}

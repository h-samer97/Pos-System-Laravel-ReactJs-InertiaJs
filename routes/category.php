<?php


  declare(strict_types=1);

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {

  Route::resource('categories', CategoriesController::class)->only('index', 'create', 'update', 'delete');

});
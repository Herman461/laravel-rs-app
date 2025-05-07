<?php

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/',  [CatalogController::class, 'render']);

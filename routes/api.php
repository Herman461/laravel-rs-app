<?php

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::post('/catalog/feed',  [CatalogController::class, 'getFilteredProducts']);

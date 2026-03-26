<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

Route::resource('candidates', CandidateController::class)->only([
    'index', 'store', 'edit', 'update', 'destroy'
]);

Route::get('/', fn() => redirect()->route('candidates.index'));
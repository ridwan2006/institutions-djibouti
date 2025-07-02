<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstitutionController;
use App\Models\Institution;

Route::get('/api/institutions', function () {
    return Institution::select('name', 'latitude', 'longitude', 'address', 'email')->get();
});

Route::get('/', [InstitutionController::class, 'index'])->name('institutions.index');


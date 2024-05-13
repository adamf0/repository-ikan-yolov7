<?php

use App\Http\Controllers\FamilyGuideApiController;
use App\Http\Controllers\KlasifikasiApiController;
use Illuminate\Support\Facades\Route;

Route::get('/family_guide',[FamilyGuideApiController::class,"listDropdown"])->name('api.familyguide.listDropdown');
Route::post('/family_guide',[FamilyGuideApiController::class,"list"])->name('api.familyguide.list');
Route::post('/klasifikasi',[KlasifikasiApiController::class,"index"])->name('api.klasifikasi.index');
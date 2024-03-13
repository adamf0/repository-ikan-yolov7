<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AcknowledgementsController;
use App\Http\Controllers\FamilyGuideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,"index"])->name('home');
Route::get('/about',[AboutController::class,"index"])->name('about');
Route::get('/family_guide',[FamilyGuideController::class,"index"])->name('familyguide');
Route::get('/search',[SearchController::class,"index"])->name('search');
Route::get('/searchv2',[SearchController::class,"indexv2"])->name('searchv2');
Route::get('/acknowledgements',[AcknowledgementsController::class,"index"])->name('acknowledgements');
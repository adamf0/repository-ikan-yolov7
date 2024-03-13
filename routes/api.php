<?php

use App\Http\Controllers\FamilyGuideApiController;
use Illuminate\Support\Facades\Route;

Route::get('/family_guide',[FamilyGuideApiController::class,"list"])->name('api.familyguide.list');
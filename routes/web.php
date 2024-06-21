<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AcknowledgementsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FamilyGuideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogIkanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NegaraSelect2Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserSelect2Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,"index"])->name('home');
Route::get('/about',[AboutController::class,"index"])->name('about');
Route::get('/family_guide',[FamilyGuideController::class,"index"])->name('familyguide');
Route::get('/search/{spesies}',[SearchController::class,"index"])->name('search');
Route::get('/searchv2/{klasifikasi}',[SearchController::class,"indexv2"])->name('searchv2');
Route::get('/acknowledgements',[AcknowledgementsController::class,"index"])->name('acknowledgements');

Route::get('/logout', [LoginController::class,"logout"])->name('login.logout');
Route::get('/login', [LoginController::class,"index"])->name('login.index');
Route::post('/login', [LoginController::class,"dologin"])->name('login.dologin');
Route::get('/register',[RegisterController::class,"index"])->name('register.index');
Route::post('/register',[RegisterController::class,"store"])->name('register.store');

Route::get('/dashboard', [DashboardController::class,"index"])->name('dashboard.index');

Route::get('/profile', [ProfileController::class,"index"])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class,"edit"])->name('profile.edit');
Route::post('/profile/save', [ProfileController::class,"update"])->name('profile.update');

Route::get('/katalog_ikan',[KatalogIkanController::class,"index"])->name('katalog_ikan.index');
Route::get('/katalog_ikan/add',[KatalogIkanController::class,"add"])->name('katalog_ikan.add');
Route::post('/katalog_ikan/store',[KatalogIkanController::class,"store"])->name('katalog_ikan.store');
Route::get('/katalog_ikan/edit/{id}',[KatalogIkanController::class,"edit"])->name('katalog_ikan.edit');
Route::post('/katalog_ikan/update',[KatalogIkanController::class,"update"])->name('katalog_ikan.update');
Route::get('/katalog_ikan/delete/{id}',[KatalogIkanController::class,"delete"])->name('katalog_ikan.delete');

Route::get('/list_negara',[NegaraSelect2Controller::class,"list"])->name('select2.negara.list');
Route::get('/list_user',[UserSelect2Controller::class,"list"])->name('select2.user.list');

Route::get('/project',[ProjectController::class,"index"])->name('project.index');
Route::get('/project/{id}',[ProjectController::class,"detail"])->name('project.detail');
Route::get('/accept_project/{id_member}',[ProjectController::class,"verifyInvite"])->name('project.verifyInvite');
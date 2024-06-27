<?php

use App\Http\Controllers\ArsipPublikasiApiController;
use App\Http\Controllers\BeritaApiController;
use App\Http\Controllers\ClassificationProjectApiController;
use App\Http\Controllers\FamilyGuideApiController;
use App\Http\Controllers\KatalogIkanApiController;
use App\Http\Controllers\KlasifikasiApiController;
use App\Http\Controllers\ProjectApiController;
use App\Http\Controllers\VideoApiController;
use Illuminate\Support\Facades\Route;

Route::get('/family_guide',[FamilyGuideApiController::class,"listDropdown"])->name('api.familyguide.listDropdown');
Route::post('/family_guide',[FamilyGuideApiController::class,"list"])->name('api.familyguide.list');
Route::post('/klasifikasi',[KlasifikasiApiController::class,"index"])->name('api.klasifikasi.index');

Route::get('/list_project/{id_user}',[ProjectApiController::class,"list"])->name('api.project.list');
Route::post('/project/store',[ProjectApiController::class,"store"])->name('api.project.store');
Route::get('/project/delete/{id}',[ProjectApiController::class,"delete"])->name('api.project.delete');
Route::post('/project/invite',[ProjectApiController::class,"invite"])->name('api.project.invite');

Route::get('/list_classproject/{id_project}',[ClassificationProjectApiController::class,"list"])->name('api.classproject.list');
Route::post('/classproject/save',[ClassificationProjectApiController::class,"save"])->name('api.classproject.save');
Route::get('/classproject/destroy/{id_project}',[ClassificationProjectApiController::class,"destroy"])->name('api.classproject.destroy');
Route::post('/classproject/update',[ClassificationProjectApiController::class,"update"])->name('api.classproject.update');
Route::post('/classproject/store',[ClassificationProjectApiController::class,"store"])->name('api.classproject.store');
Route::get('/classproject/delete/{id_project}/{id}',[ClassificationProjectApiController::class,"delete"])->name('api.classproject.delete');

Route::get('/katalog_ikan/{id}',[KatalogIkanApiController::class,"detail"])->name('api.KatalogIkan.detail');


Route::get('/datatable/katalog_ikan',[KatalogIkanApiController::class,"index"])->name('datatable.KatalogIkan.index');
Route::get('/datatable/video',[VideoApiController::class,"index"])->name('datatable.Video.index');
Route::get('/datatable/arsip_publikasi',[ArsipPublikasiApiController::class,"index"])->name('datatable.ArsipPublikasi.index');
Route::get('/datatable/berita',[BeritaApiController::class,"index"])->name('datatable.Berita.index');
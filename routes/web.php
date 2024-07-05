<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AcknowledgementsController;
use App\Http\Controllers\ArchivePublicationController;
use App\Http\Controllers\ArsipPublikasiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FamilyGuideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogIkanController;
use App\Http\Controllers\KatalogIkanSelect2Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NegaraSelect2Controller;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsVideoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserSelect2Controller;
use App\Http\Controllers\VideoController;
use App\Http\Middleware\ThrowSessionUI;
use App\Models\Ikan;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/', [HomeController::class,"index"])->name('home');
Route::get('/about',[AboutController::class,"index"])->name('about');
Route::get('/family_guide',[FamilyGuideController::class,"index"])->name('familyguide');
Route::get('/search/{spesies}',[SearchController::class,"index"])->name('search');
Route::get('/searchv2/{klasifikasi}',[SearchController::class,"indexv2"])->name('searchv2');
// Route::get('/acknowledgements',[AcknowledgementsController::class,"index"])->name('acknowledgements');

Route::get('/logout', [LoginController::class,"logout"])->name('login.logout');
Route::get('/login', [LoginController::class,"index"])->name('login.index');
Route::post('/login', [LoginController::class,"dologin"])->name('login.dologin');
Route::get('/register',[RegisterController::class,"index"])->name('register.index');
Route::post('/register',[RegisterController::class,"store"])->name('register.store');

Route::get('/archive_publicaton',[ArchivePublicationController::class,"index"])->name('archive_publicaton');
Route::get('/news',[NewsController::class,"index"])->name('news');
Route::get('/news/detail/{id}',[NewsController::class,"detail"])->name('news.detail');
Route::get('/news/video',[NewsVideoController::class,"index"])->name('news_video');
// Route::get('/news/blogs',[NewsBlogController::class,"index"])->name('news_blog.index');
// Route::get('/news/blogs',[NewsBlogController::class,"index"])->name('news_blog.index');

Route::get('/sitemap.xml', function(){
    $sitemap = Sitemap::create()
    ->add(Url::create('/'))
    ->add(Url::create('/about'))
    ->add(Url::create('/family_guide'))
    ->add(Url::create('/acknowledgements'))
    ->add(Url::create('/archive_publicaton'))
    ->add(Url::create('/news'))
    //detail berita belum
    ->add(Url::create('/news/video'))    
    ->add(Url::create('/login'))
    ->add(Url::create('/register'));

    $ikan = Ikan::get();
    $ikan->each(fn($item)=> $sitemap->add(Url::create("/search/{$item->spesies}")));

    $sitemap->writeToFile(public_path('sitemap.xml'));
});

Route::middleware(ThrowSessionUI::class)->group(function () {

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

Route::get('/berita',[BeritaController::class,"index"])->name('berita.index');
Route::get('/berita/add',[BeritaController::class,"add"])->name('berita.add');
Route::post('/berita/store',[BeritaController::class,"store"])->name('berita.store');
Route::get('/berita/edit/{id}',[BeritaController::class,"edit"])->name('berita.edit');
Route::post('/berita/update',[BeritaController::class,"update"])->name('berita.update');
Route::get('/berita/delete/{id}',[BeritaController::class,"delete"])->name('berita.delete');

Route::get('/video',[VideoController::class,"index"])->name('video.index');
Route::get('/video/add',[VideoController::class,"add"])->name('video.add');
Route::post('/video/store',[VideoController::class,"store"])->name('video.store');
Route::get('/video/edit/{id}',[VideoController::class,"edit"])->name('video.edit');
Route::post('/video/update',[VideoController::class,"update"])->name('video.update');
Route::get('/video/delete/{id}',[VideoController::class,"delete"])->name('video.delete');

Route::get('/arsip_publikasi',[ArsipPublikasiController::class,"index"])->name('arsip_publikasi.index');
Route::get('/arsip_publikasi/add',[ArsipPublikasiController::class,"add"])->name('arsip_publikasi.add');
Route::post('/arsip_publikasi/store',[ArsipPublikasiController::class,"store"])->name('arsip_publikasi.store');
Route::get('/arsip_publikasi/edit/{id}',[ArsipPublikasiController::class,"edit"])->name('arsip_publikasi.edit');
Route::post('/arsip_publikasi/update',[ArsipPublikasiController::class,"update"])->name('arsip_publikasi.update');
Route::get('/arsip_publikasi/delete/{id}',[ArsipPublikasiController::class,"delete"])->name('arsip_publikasi.delete');

Route::get('/list_negara',[NegaraSelect2Controller::class,"list"])->name('select2.negara.list');
Route::get('/list_user',[UserSelect2Controller::class,"list"])->name('select2.user.list');
Route::get('/list_spesies',[KatalogIkanSelect2Controller::class,"list"])->name('select2.katalogikan.list');

Route::get('/project',[ProjectController::class,"index"])->name('project.index');
Route::get('/project/{id}',[ProjectController::class,"detail"])->name('project.detail');
Route::get('/accept_project/{id_member}',[ProjectController::class,"verifyInvite"])->name('project.verifyInvite');

Route::get('/tes',function(){
    $result = array(); 

    $currentDirectory = scandir(public_path()); 
    foreach ($currentDirectory as $key => $value) 
    { 
        if(!in_array($value, array(".",".."))) 
        { 
            if (is_dir(public_path() . DIRECTORY_SEPARATOR.$value)) 
            { 
                 $result[] = $value; 
                 $command = sprintf("mv %s %s", (public_path() . DIRECTORY_SEPARATOR.$value), (public_path() . DIRECTORY_SEPARATOR.strtolower($value)));
                 exec($command);
                 echo $command;
            } 
        } 
   } 
    // rename("/tmp/tmp_file.txt", "/home/user/login/docs/my_file.txt");
});
});
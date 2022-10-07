<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::controller(AlbumsController::class)->group(function (){
    Route::get('/albums', 'index')->name('albums.index');
    Route::get('/albums/create', 'create')->name('albums.create');
    Route::post('/albums', 'store')->name('albums.store');
    Route::get('/albums/{id}', 'destroy')->name('albums.destroy');
    Route::get('/albums/choose/{id}', 'choose')->name('albums.choose');



});
Route::controller(HomeController::class)->group(function (){
    Route::get('/home', 'index')->name('home');

});

Route::controller(PhotosController::class)->group(function (){
    Route::get('/album/{id}', 'index')->name('photos.list');
    Route::get('/photos/gallery/{id}', 'gallery')->name('photos.gallery');
    Route::get('/photos/create/{id}', 'create')->name('photos.createupload');
    Route::post('/photos','store')->name('photos.storeupload');
    Route::post('/photos/store','store')->name('photos.store');

});







// Route::resource('albums','AlbumsController');




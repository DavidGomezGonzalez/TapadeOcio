<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DashboardCotroller;
use App\Http\Livewire\UsersTable;

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
    return view('welcome');
})->name('welcome');


/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
    ])->group(function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/users', 'AdminController@users');
    Route::get('/admin/settings', 'AdminController@settings');
});*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware([
        'admin'
    ])->group(function () {

        Route::get('/dashboard', DashboardCotroller::class)->name('dashboard');

        Route::controller(UsersController::class)->group(function () {
            Route::get('/users', UsersTable::class)->name('users.index');
            Route::get('/users/{id}', 'edit')->name('users.edit');
            Route::put('/users/{id}', 'update')->name('users.update');
            Route::delete('/users/{id}', 'destroy')->name('users.destroy');
        });

        Route::resource('categories', CategoryController::class);
        Route::resource('subcategories', SubcategoryController::class);
        Route::resource('banners', BannerController::class);

        Route::get('/search_geolocation', [BannerController::class, 'search_geolocation'])->name('search.geolocation');

        Route::get('sales-chart', [AnalyticsController::class, 'salesChart']);
    });
});

//Select2
Route::get('autocomplete', [MunicipioController::class, 'autocomplete'])->name('autocomplete');

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});


Route::get('/test', function () {

    /* $provincia = Provincia::find(14);
 
     foreach ($provincia->municipios as $municipio) {
         echo $municipio->municipio."<br>";
     }*/
});

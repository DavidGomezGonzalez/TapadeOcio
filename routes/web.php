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
use App\Http\Controllers\IconController;
use App\Http\Livewire\UsersTable;
use App\Models\Banner;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

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

/*Route::get('/', function () {

    $user = 0;
    $municipio = 0;
    if (Auth::guard()->check()) { //Loggueado
        //Obtener usuario
        $user      = Auth::guard()->user();
        $municipio = $user->municipio;
    }

    $banners = Banner::with(['category', 'municipio'])->get();

    return view('welcome', ['municipio' => $municipio, 'banners' => $banners]);
})->name('welcome');*/

Route::get('/', [BannerController::class, 'welcome'])->name('welcome');
Route::get('/banner/{id}', [BannerController::class, 'view'])->name('banners.view');
Route::post('banners/filter', [App\Http\Controllers\BannerController::class, 'filter']);



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
        Route::post('/banners/{banner}/delete-image', [BannerController::class, 'deleteImage'])->name('banners.deleteImage');

        Route::get('/search_geolocation', [BannerController::class, 'search_geolocation'])->name('search.geolocation');

        Route::get('sales-chart', [AnalyticsController::class, 'salesChart']);

        //Icons
        Route::resource('icons', 'App\Http\Controllers\IconController');
        //Route::get('/icons/create', 'App\Http\Controllers\IconController@create')->name('icons.create');
        //Route::get('/icons/create', [IconController::class, 'create'])->name('icons.create');


    });
});

//Select2
Route::get('autocomplete', [MunicipioController::class, 'autocomplete'])->name('municipality-autocomplete');
Route::get('select2', [SubcategoryController::class, 'select2'])->name('subcategory-autocomplete');

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

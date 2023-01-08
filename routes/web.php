<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Livewire\UsersTable;
use App\Models\Provincia;

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
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/users', UsersTable::class)->name('users');
    Route::get('/users/{id}', function ($id) {
        return view('users.update', ['id' => $id]);
    })->name('user-edit');
});

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

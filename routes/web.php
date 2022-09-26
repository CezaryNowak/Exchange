<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\userController;
use App\Http\Controllers\GoldController;
use App\Http\Controllers\WatchedCurrencyController;
use App\Http\Controllers\CurrencyController;

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

Route::get('/lang/{lang}', [LanguageController::class, 'changeLang', 'lang'])->name('lang.change');

//Homepage
Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Register form
Route::get('/register', [userController::class, 'create'])->name('register');

// Create new user
Route::post('/users', [userController::class, 'store']);

// ||url
Route::get('/users', [userController::class, 'create']);

// Login form
Route::get('/login', [userController::class, 'login'])->name('login');

// Log user in
Route::post('/user/login', [userController::class, 'authenticate']);

// ||url
Route::get('/user/login', [userController::class, 'login']);

// Delete account
Route::post('/user/delete', [userController::class, 'destroy']);

// Logged sites
Route::group(['middleware' => ['auth']], function () {

    // Logout
    Route::post('/user/logout', [userController::class, 'logout']);

    //  User settings
    Route::get('/user/settings', [userController::class, 'edit'])->name('userSettings');

    // Change password
    Route::post('/user/changePass', [userController::class, 'update']);

    // ||url
    Route::get('/user/changePass', [userController::class, 'edit']);

    // DELETE||url
    Route::get('/user/delete', [userController::class, 'edit']);

    // Gold
    Route::get('/gold', [GoldController::class, 'index'])->name('gold');

    // Observed Currency
    Route::get('/watched', [WatchedCurrencyController::class, 'index'])->name('watched');

    // Add to watched
    Route::post('/observe', [WatchedCurrencyController::class, 'store']);

    // Delete from watchlist
    Route::post('/observe/delete', [WatchedCurrencyController::class, 'destroy']);
    
    // Any currency
    Route::get('/currency/{currency?}/{date?}', [CurrencyController::class, 'getCurrency','currency','date',])->name('currency');
  
    Route::post('/setcurrency', [CurrencyController::class, 'setUrl']);
    

    
});

/*
{ab} ab must be
{ab?} ab is optional
Route::get('/{ab?}',[HomeController::class,'nextStr','ab']);
*/

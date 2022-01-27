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

// Route::get('/', function () {
//     return view('main');
// });


Route::get('/',[\App\Http\Controllers\ItemsController::class,'items'])->name('home');

Route::get('/cat/{id}',[\App\Http\Controllers\ItemsController::class,'items']);

Route::get('/item/{id}',[\App\Http\Controllers\ItemsController::class,'openItem'])->name('item');

Route::middleware(['guest'])->group(function(){
    Route::post('/registration', [\App\Http\Controllers\RegisterController::class, 'registration'])->name('registration');
    Route::post('/auth', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/profile', [\App\Http\Controllers\RegisterController::class, 'profileRedirect'])->name('profileRedirect');
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'cartRedirect'])->name('cartRedirect');
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    Route::post('/item/{id}/newRewiew', [\App\Http\Controllers\ItemsController::class, 'newRewiew'])->name('newRewiew');
    Route::post('/addCart', [\App\Http\Controllers\CartController::class, 'addItemToCart'])->name('addItemToCart');
    Route::post('/countItem', [\App\Http\Controllers\CartController::class, 'countItem'])->name('countItem');
    Route::get('/removeItemFromCart/{id}', [\App\Http\Controllers\CartController::class, 'removeItem'])->name('removeItemFromCart');
    Route::get('/payment', [\App\Http\Controllers\PaymentController::class, 'paymentRedirect'])->name('payment');
    Route::post('/sendOrder', [\App\Http\Controllers\PaymentController::class, 'sendOrder'])->name('sendOrder');
    Route::get('/success', [\App\Http\Controllers\PaymentController::class, 'successPayment'])->name('successPayment');

});





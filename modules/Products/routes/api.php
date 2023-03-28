<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Products\App\Http\Controllers\API\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {

    ////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////// THIS CODE IS TO MOCK USER LOGIN ///////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    $user = User::first();

    if (! $user) {
        Artisan::call('db:seed');
        $user = User::first();
    }

    Auth::login(User::first());
    ////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::resource('products', ProductController::class);
    });
});
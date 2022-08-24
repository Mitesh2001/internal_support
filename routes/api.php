<?php

use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\ContactController;
use App\Http\Controllers\api\TicketController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['as' => 'api.'], function () {

    Route::post('user', [UserController::class,'register']);
    Route::post('login', [UserController::class,'authenticate']);

    Route::group(['middleware' => ['jwt.verify']], function() {

        Route::get('auth_user',[UserController::class,'getAuthenticatedUser']);
        Route::post('logout', [UserController::class,'logout']);

        Route::resource('ticket',TicketController::class);
        Route::post('change_ticket_details',[TicketController::class,'changeTicketDetails']);

        Route::get('change_agent',[TicketController::class,'changeAgent']);

        Route::resource('contacts',ContactController::class);
        Route::resource('company',CompanyController::class);

    });

});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//authentication
Route::get('/', function () {
    return view('register');
});
Route::post('/', [AuthController::class, 'register']);

Route::get('/login', function(){
    return view('login');
});
Route::post('/login', [AuthController::class, 'login']);

Route::get('/home', [AuthController::class, 'homeView']);

//mail
Route::get('/compose/{email}', [MailController::class, 'composeView']);
Route::post('/compose/{email}', [MailController::class, 'compose']);

Route::get('/sent/{email}', [MailController::class, 'sent']);

Route::get('/received/{email}', [MailController::class, 'received']);

Route::get('/moveTrashR/{email}/{id}', [MailController::class, 'moveTrashR']);
Route::get('/moveTrashS/{email}/{id}', [MailController::class, 'moveTrashS']);

Route::get('/trash/{email}', [MailController::class, 'trash']);
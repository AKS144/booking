<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketsController;

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
Route::get('/new_ticket', [TicketsController::class, 'create']);
// Route::get('/new_ticket', 'TicketsController@create');
Route::post('/new_ticket', [TicketsController::class, 'store']);

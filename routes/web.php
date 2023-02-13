<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SexoController;
use App\Http\Controllers\IdiomaController;

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
    return redirect('/sexos');
});
// Route::get('/', [SexoController::class, 'index']);

Route::resource('sexos', SexoController::class);
Route::resource('idiomas', IdiomaController::class);


 



 

<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImportController;

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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/excel-import', [ImportController::class, 'index']);
    Route::post('/excel-import/send', [ImportController::class, 'import']);

    Route::get('/excel-import/backpacks', [ImportController::class, 'indexBackpacks']);
    Route::post('/excel-import/backpacks/send', [ImportController::class, 'backpacks']);

});

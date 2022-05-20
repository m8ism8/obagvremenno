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


Route::get('/kek', function () {
    return view('halyk.index');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    //Кошельки
    Route::get('/excel-import', [ImportController::class, 'index']);
    Route::post('/excel-import/send', [ImportController::class, 'import']);

    //Рюкзаки
    Route::get('/excel-import/backpacks', [ImportController::class, 'indexBackpacks']);
    Route::post('/excel-import/backpacks/send', [ImportController::class, 'backpacks']);

    Route::get('/excel-import/bags', [ImportController::class, 'indexBags']);
    Route::post('/excel-import/bags/send', [ImportController::class, 'bags']);

    Route::get('/excel-import/kaspi', [ImportController::class, 'indexKaspi']);
    Route::post('/excel-import/kaspi/send', [ImportController::class, 'kaspi']);
});

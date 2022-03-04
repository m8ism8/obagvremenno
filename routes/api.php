<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    CallBackController,
    ProductController,
    AuthController,
    PageController,
    ConstructorController,
    CartController
};

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

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/product/{id}/favourite', [ProductController::class, 'favourite']);
    Route::get('/user/favourites', [AuthController::class, 'favourites']);
    Route::post('/user/edit', [AuthController::class, 'edit']);
    Route::post('/user', [AuthController::class, 'user']);
    Route::get('/user/history', [AuthController::class, 'history']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/product/{id}/review', [AuthController::class, 'review']);
    Route::get('/user/get-products', [AuthController::class, 'getProducts']);
    Route::post('/user/subscribe', [AuthController::class, 'subscribe']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/callback/send', [CallBackController::class, 'callback']);

Route::get('/index', [ProductController::class, 'index']);
Route::get('/get-categories', [ProductController::class, 'getCategories']);
Route::get('/recomendedProducts', [ProductController::class, 'getRecomended']);
Route::get('/category/{category}', [ProductController::class, 'category']);
Route::get('/subcategory/{subcategory}', [ProductController::class, 'subcategory']);
Route::get('/subcategory/{subcategory}/filtered', [ProductController::class, 'subcategoryFiltered']);
Route::get('/product/{product}', [ProductController::class, 'product']);
Route::get('/products/search/{string}', [ProductController::class, 'search']);
Route::get('/certificates', [ProductController::class, 'certificates']);

Route::get('/constructor/{slug}', [ConstructorController::class, 'constructor']);
Route::get('/constructor/category/{category}', [ConstructorController::class, 'category']);

Route::post('/cart/store', [CartController::class, 'store']);

Route::get('/get-cities', [PageController::class, 'getCities']);
Route::get('/page/history', [PageController::class, 'history']);
Route::get('/page/mission', [PageController::class, 'mission']);
Route::get('/page/brand-info', [PageController::class, 'brandInfo']);
Route::get('/page/get-news', [PageController::class, 'getNews']);

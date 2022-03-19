<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    CallBackController,
    ProductController,
    AuthController,
    PageController,
    ConstructorController,
    CartController,
    InformationPageController,
    ContactController,
    CompleteController
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
    Route::delete('/product/{id}/favourite', [ProductController::class, 'favouriteDelete']);
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
//google register
Route::get('google-register', [AuthController::class, 'googleRegister']);
Route::get('google-callback',[AuthController::class,'googleCallback']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/callback/send', [CallBackController::class, 'callback']);

Route::get('/index', [ProductController::class, 'index']);
Route::get('/get-categories', [ProductController::class, 'getCategories']);
Route::post('/recomended-products', [ProductController::class, 'getRecomended']);
Route::get('/category/{category}', [ProductController::class, 'category']);
Route::post('/category/{category}/filtered', [ProductController::class, 'categoryFiltered']);
Route::get('/subcategory/{subcategory}', [ProductController::class, 'subcategory']);
Route::post('/subcategory/{subcategory}/filtered', [ProductController::class, 'subcategoryFiltered']);
Route::get('/product/{product}', [ProductController::class, 'product']);
Route::get('/products/search/{string}', [ProductController::class, 'search']);
Route::get('/certificates', [ProductController::class, 'certificates']);

Route::get('constructor', [ConstructorController::class, 'index']);
Route::get('/constructor/{slug}', [ConstructorController::class, 'constructor']);
Route::get('/constructor/category/{category}', [ConstructorController::class, 'category']);

Route::post('/cart/store', [CartController::class, 'store']);

Route::get('/get-cities', [PageController::class, 'getCities']);
Route::get('/page/history', [PageController::class, 'history']);
Route::get('/page/mission', [PageController::class, 'mission']);
Route::get('/page/brand-info', [PageController::class, 'brandInfo']);
Route::get('/page/get-news', [PageController::class, 'getNews']);

//Копмлектующие
Route::get('subcategory/{id}/complete', [CompleteController::class, 'index']);
Route::get('complete/{id}', [CompleteController::class, 'show']);


//Контакты
Route::get('contact',[ContactController::class, 'index']);
Route::post('contact',[ContactController::class, 'create']);


//Information Pages
Route::get('history-and-mission',[InformationPageController::class, 'historyMission']);
Route::get('social-mission',[InformationPageController::class, 'socialMission']);
Route::get('brand-information',[InformationPageController::class, 'brandInformation']);
Route::get('product-information',[InformationPageController::class, 'productInformation']);
Route::get('all-about-products',[InformationPageController::class, 'allAboutProducts']);
Route::get('research-and-innovation',[InformationPageController::class, 'researchInnovation']);

Route::get('shipping-and-payment',[InformationPageController::class, 'shippingPayment']);
Route::get('return-information',[InformationPageController::class, 'returnInformation']);
Route::get('loyalty-system',[InformationPageController::class, 'loyaltySystem']);
Route::get('information_for_corporate_clients', [InformationPageController::class, 'corporateInformation']);
Route::get('gift-rules', [InformationPageController::class, 'giftRule']);
Route::get('guarantee', [InformationPageController::class, 'guarantee']);
Route::get('rule-operation', [InformationPageController::class, 'ruleOperation']);

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

Route::group(['middleware' => ['auth:sanctum']], function () {
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

Route::middleware('auth:sanctum')
     ->get('/user', function (Request $request) {
         return $request->user();
     })
;
//google register
Route::get('google-register', [AuthController::class, 'googleRegister']);
Route::get('google-callback', [AuthController::class, 'googleCallback']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/callback/send', [CallBackController::class, 'callback']);


Route::get('category/promotional', [ProductController::class, 'promotional']);

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
Route::get('/cart/test', [CartController::class, 'test']);

Route::get('/get-cities', [PageController::class, 'getCities']);
Route::get('/page/history', [PageController::class, 'history']);
Route::get('/page/mission', [PageController::class, 'mission']);
Route::get('/page/brand-info', [PageController::class, 'brandInfo']);
Route::get('/page/banners', [PageController::class, 'getBanners']);
Route::get('/page/complete-products', [PageController::class, 'getCompleteProducts']);

//Копмлектующие
Route::get('subcategory/{id}/complete', [CompleteController::class, 'index']);
Route::get('complete/{id}', [CompleteController::class, 'show']);

//Вакансии
Route::post('vacancies', [CallBackController::class, 'vacancies']);

//Контакты
Route::get('contact', [ContactController::class, 'index']);
Route::post('contact', [ContactController::class, 'create']);


//Information Pages
Route::get('save-your-obag', [InformationPageController::class, 'saveYourObag']);
Route::get('history-and-mission', [InformationPageController::class, 'historyMission']);
Route::get('social-mission', [InformationPageController::class, 'socialMission']);
Route::get('brand-information', [InformationPageController::class, 'brandInformation']);
Route::get('product-information', [InformationPageController::class, 'productInformation']);
Route::get('all-about-products', [InformationPageController::class, 'allAboutProducts']);
Route::get('research-and-innovation', [InformationPageController::class, 'researchInnovation']);

Route::get('shipping-and-payment', [InformationPageController::class, 'shippingPayment']);
Route::get('return-information', [InformationPageController::class, 'returnInformation']);
Route::get('loyalty-system', [InformationPageController::class, 'loyaltySystem']);
Route::get('information_for_corporate_clients', [InformationPageController::class, 'corporateInformation']);
Route::get('gift-rules', [InformationPageController::class, 'giftRule']);
Route::get('guarantee', [InformationPageController::class, 'guarantee']);
Route::get('rule-operation', [InformationPageController::class, 'ruleOperation']);

Route::get('mobile-shopping', [InformationPageController::class, 'mobileShopping']);
Route::get('shops', [InformationPageController::class, 'shops']);

Route::post('sales-create', [PageController::class, 'salesCreate']);
Route::post('news-create', [PageController::class, 'newsCreate']);

Route::delete('sales-delete/{id}', [PageController::class, 'salesDelete']);
Route::delete('news-delete/{id}', [PageController::class, 'newsDelete']);

Route::put('sales-change/{id}', [PageController::class, 'salesChange']);
Route::put('news-change/{id}', [PageController::class, 'newsChange']);


//Подписка
Route::post('subscription', [AuthController::class, 'subscription']);
Route::delete('subscription', [AuthController::class, 'deleteSubscription']);

//Заказ в один клик
Route::post('order-callback', [CallBackController::class, 'order']);
Route::get('delivery-price', [CartController::class, 'deliveryPrice']);

//Уведомить о поступлении
Route::post('notify', [CallBackController::class, 'notify']);

Route::get('/seo/{title}', [InformationPageController::class, 'seo']);
Route::get('/seo/parser/test', [InformationPageController::class, 'seoParser']);

Route::get('page/sales', [PageController::class, 'getNews']);
Route::get('/page/sales/{id}', [PageController::class, 'new']);

///page/sales
///page/get-news/{id}
Route::get('/page/get-news', [PageController::class, 'sales']);
Route::get('/page/get-news/{id}', [PageController::class, 'salesById']);

Route::get('page/exploitation-accessories', [InformationPageController::class, 'exploitationAccessories']);
Route::get('page/exploitation-accessories/{id}', [InformationPageController::class, 'exploitationAccessoriesById']);

Route::get('page/gift-certificates', [InformationPageController::class, 'giftCertificates']);

Route::get('xml', [ProductController::class, 'xml']);

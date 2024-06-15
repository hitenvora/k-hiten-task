<?php

use App\Http\Controllers\API\AppOrderCartController;
use App\Http\Controllers\API\AppOrderController;
use App\Http\Controllers\API\CartsController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\Web\BlogsController;
use App\Http\Controllers\API\Web\ContectusesController;
use App\Http\Controllers\API\CustomersController;
use App\Http\Controllers\API\GstAndTextCategoriesController;
use App\Http\Controllers\API\Product_imgsController;
use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\SubCategoriesController;
use App\Http\Controllers\API\userController;
use App\Http\Controllers\API\Web\FrequentlyAskedQuestionsController;
use App\Http\Controllers\API\Web\NewsLettersController;
use App\Http\Controllers\API\Web\ProfilesController;
use App\Http\Controllers\API\Web\SubscribeNowsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('migrate', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    return 'Migration ran successfullly !';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(userController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('addUser', 'addUser');
    Route::delete('deleteUser/{id}', 'deleteUser');
    Route::post('editUser/{id}', 'editUser');
    Route::post('logout', 'logout/{id}');
});



Route::controller(CustomersController::class)->group(function () {
    Route::get('customers/{id}', 'show');
    Route::post('customers/{id}', 'update');
    Route::DELETE('customers/{id}', 'destroy');
    Route::post('customers', 'store')->name("customers.store");
    Route::get('customers', 'index');
});

Route::controller(Product_imgsController::class)->group(function () {
    Route::get('product-img/{id}', 'show');
    Route::post('product-img/{id}', 'update');
    Route::DELETE('product-img/{id}', 'destroy');
    Route::post('product-img', 'store');
    Route::get('product-img', 'index');
});

Route::controller(GstAndTextCategoriesController::class)->group(function () {
    Route::get('gst_text-categorie/{id}', 'show');
    Route::post('gst_text-categorie/{id}', 'update');
    Route::DELETE('gst_text-categorie/{id}', 'destroy');
    Route::post('gst_text-categorie', 'store');
    Route::get('gst_text-categorie', 'index');
});

Route::controller(CategoriesController::class)->group(function () {
    Route::get('categories/{id}', 'show');
    Route::post('categories/{id}', 'update');
    Route::DELETE('categories/{id}', 'destroy');
    Route::post('categories', 'store')->name("api.customers.store");
    Route::get('categories', 'index');
});

Route::controller(SubCategoriesController::class)->group(function () {
    Route::get('subcategories/{id}', 'show');
    Route::post('subcategories/{id}', 'update');
    Route::DELETE('subcategories/{id}', 'destroy');
    Route::post('subcategories', 'store');
    Route::get('subcategories', 'index');
});

Route::controller(ProductsController::class)->group(function () {
    Route::get('product/{id}', 'show');
    Route::get('product', 'index');

    Route::get('popular/product', 'popularList');
    Route::get('product/search-by-barcode/{barcodeId}', 'barcode');
    Route::get('product/search-by-subcategory/{subcategoryId}', 'subcategory');
    Route::get('product/search-by-name/{name}', 'productByName');
});
Route::controller(CartsController::class)->group(function () {
    Route::get('cart/{id}', 'show');
    Route::post('cart/{id}', 'update');
    Route::DELETE('cart/{id}', 'destroy');
    Route::post('cart', 'store');
    Route::get('cart', 'index');
    Route::post('create-cart', 'cart');
});


Route::controller(AppOrderCartController::class)->group(function () {
    Route::post('add/app/product/cart', 'addProductCart');
    Route::post('get/app/cart/product', 'getCartProduct');
    Route::get('get/employee/cart/product/{e_id}', 'getActiveEmployeeCartProduct');
    Route::get('get/employee/cart/product/{e_id}', 'getEmployeeCartProduct');
    Route::get('get-cart-data', 'getCartData');
    Route::post('deleteproduct', 'deleteproduct');
    Route::post('add-qty', 'updateQty');
});

Route::controller(AppOrderController::class)->group(function () {
    Route::post('store/order', 'storeOrder');
    Route::get('list/order', 'listOrder');
    Route::get('order/receipt/{o_id}', 'OrderReceipt');
    Route::get('order/token/{o_id}', 'OrderToken');
    Route::get('print/order/receipt/{o_id}', 'printOrderReceipt');
});


Route::group(['prefix' => 'web'], function () {

    Route::controller(ContectusesController::class)->group(function () {
        Route::get('contect/us/{id}', 'show');
        Route::post('contect/us/{id}', 'update');
        Route::DELETE('contect/us/{id}', 'destroy')->name('contect-us');
        Route::post('contect/us', 'store');
        Route::get('contect/us', 'index');
    });


    Route::controller(ProfilesController::class)->group(function () {
        Route::get('profile/{id}', 'show');
        Route::post('profile/{id}', 'update');
        Route::DELETE('profile/{id}', 'destroy')->name('profile.delete');
        Route::post('profile', 'store');
        Route::get('profile', 'index');
    });

    Route::controller(FrequentlyAskedQuestionsController::class)->group(function () {
        Route::get('frequently/asked/questions/{id}', 'show');
        Route::post('frequently/asked/questions/{id}', 'update');
        Route::DELETE('frequently/asked/questions/{id}', 'destroy')->name('frequently.asked.questions.delete');
        Route::post('frequently/asked/questions', 'store');
        Route::get('frequently/asked/questions', 'index');
    });

 
    
    Route::controller(BlogsController::class)->group(function () {
        Route::get('blog/{id}', 'show');
        Route::post('blog/{id}', 'update');
        Route::DELETE('blog/{id}', 'destroy')->name('frequently.asked.questions.delete');
        Route::post('blog', 'store');
        Route::get('blog', 'index');
    });


    Route::controller(NewsLettersController::class)->group(function () {
        Route::get('news/letter/{id}', 'show');
        Route::post('news/letter/{id}', 'update');
        Route::DELETE('news/letter/{id}', 'destroy')->name('frequently.asked.questions.delete');
        Route::post('news/letter', 'store');
        Route::get('news/letter', 'index');
    });


    Route::controller(SubscribeNowsController::class)->group(function () {
        Route::get('suscribe/now/{id}', 'show');
        Route::post('suscribe/now/{id}', 'update');
        Route::DELETE('suscribe/now/{id}', 'destroy')->name('frequently.asked.questions.delete');
        Route::post('suscribe/now', 'store');
        Route::get('suscribe/now', 'index');
    });

});


<?php

// use App\Http\Controllers\API\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminController;



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

Route::post('reg',[AdminController::class,'register']);
Route::post('login',[AdminController::class,'login']);
Route::post('adminpanel',[AdminController::class,'product_insert']);
Route::get('products',[AdminController::class,'show']);
Route::post('cart',[AdminController::class,'cart_show']);
Route::post('productinsertcart',[AdminController::class,'pro_insert_cart']);
Route::post('forget',[AdminController::class,'forget_pass']);

Route::post('ship',[AdminController::class,'shipping_api']);
Route::post('get_cart_id',[AdminController::class,'get_cart_id']);
Route::post('placeord',[AdminController::class,'place_order']);
Route::post('checkout',[AdminController::class,'checkout']);
Route::post('checkout_c', [AdminController::class]);

Route::post('createOrder', [AdminController::class, 'store']);

Route::get('cart_update', [AdminController::class,'cart_update']);
Route::get('cart/item/{id}', [AdminController::class, 'getCartByUser']);


Route::post('get_card_id',[AdminController::class,'get_card_id']);
Route::post('ordn',[AdminController::class,'get_order_number']);
Route::post('my_orders',[AdminController::class,'my_orders']);
Route::post('details',[AdminController::class,'details']);
Route::post('pro_display_home',[AdminController::class,'pro_display_home']);
Route::post('remove',[AdminController::class,'remove_pro_from_cart']);
Route::post('edit',[AdminController::class,'edit']);
Route::post('get_user_detail',[AdminController::class,'get_user_detail']);
Route::post('search_pro',[AdminController::class,'search_pro']);
Route::get('survey_api',[AdminController::class,'survey_api']);
Route::post('get_pro_byid',[AdminController::class,'get_pro_byid']);
Route::post('addCheckoutAddress', [AdminController::class, 'addCheckoutAddress']);
Route::get('user/{id}', [AdminController::class, 'user_show']);

   
// Route::middleware('auth:api')->get('/', function (Request $request) {
//     Route::post('update_password',[AdminController::class,'update_password']);
//     // Route::post('login',[AdminController::class,'login']);

//     return $request->user();
// });


Route::group(['middleware' => ['auth:api']], function () {
    Route::post('update_password',[AdminController::class,'update_password']);
});
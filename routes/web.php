<?php

use Illuminate\Support\Facades\Route;

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



Route::resource('customer', 'CustomerController')->middleware('auth');
Route::get('/customer/restore/{id}',['uses' => 'CustomerController@restore','as' => 'customer.restore']);

Route::resource('pet', 'PetController')->middleware('auth');;
Route::get('/pet/restore/{id}',['uses' => 'PetController@restore','as' => 'pet.restore']);

Route::resource('employee', 'EmployeeController');
Route::get('/employee/restore/{id}',['uses' => 'EmployeeController@restore','as' => 'employee.restore']);

Route::resource('grooming', 'GroomingController')->middleware('auth');
Route::get('/grooming/restore/{id}',['uses' => 'GroomingController@restore','as' => 'grooming.restore']);

Route::resource('consultation', 'ConsultationController')->middleware('auth');
Route::get('/consultation/restore/{id}',['uses' => 'ConsultationController@restore','as' => 'consultation.restore']);

Route::get('/searchCon', 'ConsultationController@search')->middleware('auth');

Route::get('/search', 'GroomingController@search')->middleware('auth');

Route::get('/index', [
        'uses' => 'ConsultationController@index',
        'as' => 'consultation.index']);

Route::get('/create', [
        'uses' => 'ConsultationController@create',
        'as' => 'consultation.create']);

Route::post('/consultation/store',['uses' => 'ConsultationController@store','as' => 'consultation.store']);

Route::get('/signup', [
        'uses' => 'EmployeeController@getSignup',
        'as' => 'employee.signup']);
Route::post('/signup', [
        'uses' => 'EmployeeController@postSignup',
        'as' => 'employee.signup']);
Route::get('profile', [
        'uses' => 'EmployeeController@getProfile',
        'as' => 'employee.profile'])->middleware('auth');
Route::get('logout', [
        'uses' => 'EmployeeController@getLogout',
        'as' => 'employee.logout']);
Route::get('/signin', [
        'uses' => 'EmployeeController@getSignin',
        'as' => 'employee.signin']);
Route::post('/signin', [
        'uses' => 'EmployeeController@postSignin',
        'as' => 'employee.signin']);

//for shop
Route::get('/shop', [
    'uses' => 'GroomingController@shop',
    'as' => 'shop.index'
    ]);
// Route::get('/review', [
//     'uses' => 'GroomingController@review',
//     'as' => 'shop.review'
//     ]);

Route::post('/history',['uses' => 'GroomingController@history','as' => 'history.history']);

Route::get('/history',['uses' => 'GroomingController@history','as' => 'history.history']);

Route::get('/grooming/review/{id}','GroomingController@review')->name('shop.review');

Route::get('/grooming/comment/{id}','GroomingController@comment')->name('shop.comment');

Route::post('/grooming/reviewStore',['uses' => 'GroomingController@reviewStore','as' => 'grooming.reviewStore']);

Route::get('shopping-cart', [
    'uses' => 'GroomingController@getCart',
    'as' => 'shop.shoppingCart'
    ]);

Route::post('checkout',[
        'uses' => 'GroomingController@postCheckout',
        'as' => 'checkout',
        
    ]);


Route::get('add-to-cart/{id}',[
        'uses'=>'GroomingController@getAddToCart',
        'as' => 'grooming.addToCart'
    ]);

// Route::get('/', [
//     'uses' => 'ItemController@index',
//     'as' => 'item.index'
//     ]);

Route::get('remove/{id}',[
        'uses'=>'GroomingController@getRemoveItem',
        'as' => 'grooming.remove'
    ]);

Route::get('reduce/{id}',[
        'uses' => 'GroomingController@getReduceByOne',
        'as' => 'grooming.reduceByOne'
    ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('front');
// });
//front-view
Route::get('/',[AdminController::class,'front']);

//register-admin
Route::get('/admin/register', [AdminController::class, 'adminRegister']);
//save-admin
Route::post('/save-admin', [AdminController::class, 'saveAdmin'])->name('save-admin');

//login-admin
Route::get('/admin/login', [AdminController::class, 'adminlogin'])->name('admin/login');

//admin-auth
Route::post('/admin/auth', [AdminController::class, 'adminAuth'])->name('admin-auth');


Route::group(['middleware' => 'customAuth'], function(){
//dashboard
Route::get('/dashboard', [AdminController::class, 'dashboard']);

//createProduct
Route::get('/createProductForm',[AdminController::class,'createProductForm']);
Route::post('/storeProducts', [AdminController::class, 'storeProducts'])->name('storeProducts');

//show Products
Route::get('/showProduct', [AdminController::class, 'showProduct']);

//show products edit form
Route::get('/productManage',[AdminController::class, 'productManage']);
//editproduct
Route::get('editProduct/{id}', [AdminController::class, 'editProduct']);
Route::put('updateProduct/{id}', [AdminController::class, 'updateProduct']);

//delete product
Route::get('deleteProduct/{id}', [AdminController::class, 'productDelete'])->name('product.delete');

//logout
Route::get('/admin/logout', [AdminController::class, 'logout']);
});
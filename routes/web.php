<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Auth;

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

Route::get('mySillyPage', function () {
    // abort with error 404
    return abort('404');
    // abort with error 403 (default error message)
    // return abort('403');
    // abort with error 403 (custom error message)
    // return abort('403', 'My Silly Error');
});

// password Forget & reset

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/clear-cache', [HomeController::class, 'cache'])->name('clear');


Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('purchase', PurchaseController::class);
    Route::resource('sales', SaleController::class);

    // profile manage
    Route::get('/profile-manage', [HomeController::class, 'profileUpdateShow'])->name('profileUpdateShow');
    Route::post('/profile-manage', [HomeController::class, 'profileUpdate'])->name('profileupdate');

    Route::get('change-password', [HomeController::class, 'passwordChangeindex'])->name('changePassword');
    Route::post('change-password', [HomeController::class, 'passwordChangeStore'])->name('change.password');


    // search
    Route::get('/search/', [ProductController::class, 'search'])->name('search');

    // stock
    Route::get('/stock', [ProductController::class, 'stock'])->name('stock');

    // supplierDue
    Route::get('/supplier-due', [SupplierController::class, 'supplierDue'])->name('supplier.due');

    // customerDue
    Route::get('/customer-due', [CustomerController::class, 'customerDue'])->name('customer.due');

    // report- sale - purchase
    Route::get('/reposts/sales', [SaleController::class, 'saleReport'])->name('saleReport');
    Route::get('/reposts/purchases', [SaleController::class, 'purchasesReport'])->name('purchasesReport');


});

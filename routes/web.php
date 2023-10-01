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

// password Forget & reset

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


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

    Route::get('change-password', [HomeController::class, 'passwordChangeindex']);
    Route::post('change-password', [HomeController::class, 'passwordChangeStore'])->name('change.password');

    // Purchase invoice

    Route::get('/generate-pdf', [PdfController::class, 'generate_pdf'])->name('generate-pdf');
    Route::get('/download-pdf', [PdfController::class, 'download_pdf']);

    // search

    // Route::post('/search', [PurchaseController::class, 'search'])->name('search');
    // Route::get('/purchase-index', [PurchaseController::class, 'index2'])->name('search');

    Route::get('/employee', [PurchaseController::class, 'index2']);
    Route::post('/employee/search', [PurchaseController::class, 'search'])->name('employee.search');
});

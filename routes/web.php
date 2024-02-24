<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Spatie\Permission\Middlewares\PermissionMiddleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return view('auth/login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('invoices/force/{id}', [InvoiceController::class,'force'])->name('invoices.force');
Route::post('invoices/restore/{id}', [InvoiceController::class,'restore'])->name('invoices.restore');
Route::get('invoices/trashed', [InvoiceController::class,'trashed'])->name('invoices.trashed');
Route::get('invoices/print/{id}', [InvoiceController::class,'print'])->name('invoices.print');
Route::get('invoices/status/{id}', [InvoiceController::class,'status'])->name('invoices.status');
Route::get('invoices/export', [InvoiceController::class, 'export'])->name('invoices.export');
Route::get('invoices/readall', [InvoiceController::class, 'readall'])->name('invoices.readall');
Route::get('invoices/notifi/{id}', [InvoiceController::class, 'notifi'])->name('invoices.notifi');
Route::resource('invoices',InvoiceController::class);

Route::get('sectionxx/{id}',[InvoiceController::class,'getProducts']);

Route::controller(ReportsController::class)->group(function(){
    Route::get('reports'                    , 'index'           )->name('reports.index');
    Route::post('reports/search'            , 'search'          )->name('reports.search');
    Route::get('reports/customer'           , 'customer'        )->name('reports.customer');
    Route::post('reports/search_customer'   , 'search_customer' )->name('reports.search_customer');
});
Route::resource('sections',SectionController::class);
Route::resource('products',ProductController::class);


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

});


Route::get('/{page}', [AdminController::class,'index']);

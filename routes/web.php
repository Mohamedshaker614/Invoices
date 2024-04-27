<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoicesAttachmentController;
use App\Http\Controllers\InvoicesDetailController;
use App\Http\Controllers\Report;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubProductController;
use App\Http\Controllers\UserController;
use App\Models\InvoicesAttachment;
use App\Models\InvoicesDetail;
use App\Models\SubProduct;
use App\Models\User;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('invoices', InvoiceController::class);
    Route::get('paid', [InvoiceController::class, 'invoicePaid'])->name('invoicePaid');
    Route::get('unpaid', [InvoiceController::class, 'invoiceUnPaid'])->name('invoiceUnPaid');
    Route::get('Partial', [InvoiceController::class, 'invoicePartial'])->name('invoicePartial');
    Route::get('status_pay/{id}', [InvoiceController::class, 'statusPay'])->name('statusPay');
    Route::get('updatestatuspay/{id}', [InvoiceController::class, 'updateStatusPay'])->name('updateStatusPay');
    Route::get('print_invoice/{id}', [InvoiceController::class, 'printInvoice'])->name('printInvoice');
    Route::get('Notification/Read', [InvoiceController::class, 'markAsRead'])->name('Notifi.Read');

    Route::resource('sections', SectionController::class);
    Route::get('section/products/{id}', [SectionController::class, 'getSectionProducts']);
    Route::resource('subproducts', SubProductController::class);
    Route::resource('invoice_detail', InvoicesDetailController::class);
    Route::resource('attachments', InvoicesAttachmentController::class);
    Route::get('showfile/{invoice_number}/{file_name}', [InvoicesDetailController::class, 'showFile'])->name('openFile');
    Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailController::class, 'download'])->name('download');
    Route::post('deletefile/{id}', [InvoicesDetailController::class, 'deletefile'])->name('deletefile');
    Route::delete('softDelete/{id}', [InvoiceController::class, 'softDelete'])->name('softDelete');
    Route::get('restore/{id}', [ArchiveController::class, 'restore'])->name('restore');
    Route::resource('Archives', ArchiveController::class);
    Route::get('invoices_export/', [InvoiceController::class, 'export'])->name('invoices_export');

    // Route::get('/{page}', [AdminController::class, 'index']);
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('index', [Report::class, 'index'])->name('reportIndex');
Route::get('invoicesReport', [Report::class, 'search'])->name('invoiceSearch');
Route::get('customer', [CustomerController::class, 'index'])->name('customer');
Route::get('customersearch', [CustomerController::class, 'SearchInvoice'])->name('customerSearch');
// Route::delete('softDelete/{$id}', [InvoiceController::class, 'softDelete'])->name('softDelete');




// Route::middleware(['web', 'auth', 'CheckAdmin'])->group(function () {
//     Route::get('/index', [AdminController::class, 'index'])->name('admin');
// });

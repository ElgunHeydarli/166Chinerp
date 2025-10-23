<?php

use App\Http\Controllers\Admin\AbandonedCargoController;
use App\Http\Controllers\Admin\BookingContainerController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\BookingDateController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ContainerController;
use App\Http\Controllers\Admin\ContainerPriceController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderCommentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderExpenseController;
use App\Http\Controllers\Admin\OrderFileController;
use App\Http\Controllers\Admin\OrderPriceController;
use App\Http\Controllers\Admin\OrderServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\DatabaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JournalEntryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\LedgerAccountController;
use Illuminate\Support\Facades\Session;

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

Route::get('/migrate', function () {
    Artisan::call('migrate');
});

Route::get('/change-lang/{lang?}', function ($lang) {
    $langs = ['az', 'en', 'zh'];
    if (in_array($lang, $langs)) {
        Session::put('locale', $lang);
    } else {
        Session::put('locale', 'az');
    }

    return redirect()->back();
})->name('change-lang');

Route::get('/database', [DatabaseController::class, 'index']);
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/order/import', [OrderController::class, 'import'])->name('order.import');
Route::post('/order/change-cbm', [OrderController::class, 'change_cbm'])->name('order.change-cbm');
Route::post('/order/divide-order', [OrderController::class, 'divide_order'])->name('order.divide-order');
Route::post('/order/{id}/combine', [OrderController::class, 'combine'])->name('order.combine');
Route::post('/order/{id}/change-user', [OrderController::class, 'change_user'])->name('order.change-user');
Route::post('/order/{id}/add-warehouse', [OrderController::class, 'add_warehouse'])->name('order.add-warehouse');
Route::post('/order/add-customer', [OrderController::class, 'add_customer']);
Route::post('/order/add-referrer', [OrderController::class, 'add_referrer']);
Route::get('/order/filter', [OrderController::class, 'filter']);
Route::get('/order/add-size', [OrderController::class, 'add_size']);
Route::get('/order/add-vin-code', [OrderController::class, 'add_vin_code']);
Route::get('/order/get-customers', [OrderController::class, 'get_customers']);
Route::get('/order/add-factory', [OrderController::class, 'add_factory']);
Route::get('/order/add-expense', [OrderController::class, 'add_expense']);
Route::get('/order/priceless', [OrderController::class, 'priceless'])->name('order.priceless');
Route::resource('order', OrderController::class)->except('destroy');
Route::get('/order/{id}/details', [OrderController::class, 'details'])->name('order.details');
Route::post('/order/{id}/destroy', [OrderController::class, 'destroy'])->name('order.destroy');
Route::get('/order/{id}/get-details', [OrderController::class, 'get_details']);
Route::put('/order/{id}/update-price', [OrderPriceController::class, 'update_price']);
Route::post('/order/{id}/set-prices', [OrderPriceController::class, 'set_prices']);
Route::put('/order/{id}/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
Route::put('/order/{id}/reject', [OrderController::class, 'reject'])->name('order.reject');
Route::put('/order/{id}/execute', [OrderController::class, 'execute'])->name('order.execute');
Route::get('/order/{id}/add-expense', [OrderExpenseController::class, 'edit'])->name('order.add-expense');
Route::post('/order/{id}/add-expense', [OrderExpenseController::class, 'update']);
Route::post('/order/{id}/booking', [OrderController::class, 'booking'])->name('order.booking');
Route::post('/order/{id}/add-files', [OrderController::class, 'add_files'])->name('order.add-files');
Route::post('/order/{id}/send-comment', [OrderCommentController::class, 'send_comment'])->name('order.send-comment');
Route::post('/order/{id}/add-railway', [OrderController::class, 'add_railway'])->name('order.add-railway');
Route::post('/order/{id}/add-declaration', [OrderController::class, 'add_declaration'])->name('order.add-declaration');
Route::post('/order/{id}/add-short-declaration', [OrderController::class, 'add_short_declaration'])->name('order.add-short-declaration');
Route::post('/order/{id}/add-images', [OrderController::class, 'add_images'])->name('order.add-images');
Route::post('/order/{id}/change-railway-status', [OrderController::class, 'change_railway_status']);
Route::get('/order/{id}/get-cbm-info', [OrderController::class, 'get_cbm_info']);
Route::get('journal-entries', [JournalEntryController::class, 'index'])->name('journal.index');
Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
Route::get('/order/{id}/get-railway-bill', [OrderFileController::class, 'get_railway_bill']);
Route::get('/order/{id}/get-declaration', [OrderFileController::class, 'get_declaration']);
Route::get('/order/{id}/get-images', [OrderFileController::class, 'get_images']);
Route::get('/order/{id}/delete-image', [OrderFileController::class, 'delete_image']);
Route::post('/order/{id}/change-container', [OrderController::class, 'change_container'])->name('order.change-container');
Route::post('/order/{id}/add-handover', [OrderController::class, 'add_handover'])->name('order.add-handover');
Route::get('/accounts/{account}', [AccountController::class, 'show'])->name('accounts.show');
Route::put('/accounts/{account}', [AccountController::class, 'update'])->name('accounts.update');

Route::post('/vendor/{id}/change-status', [VendorController::class, 'change_status'])->name('vendor.change-status');
Route::resource('vendor', VendorController::class)->except('destroy');
Route::get('/vendor/{id}/destroy', [VendorController::class, 'destroy'])->name('vendor.destroy');

Route::resource('ledger-accounts', LedgerAccountController::class)->names([
    'index' => 'admin.ledger-accounts.index',
    'create' => 'admin.ledger-accounts.create',
    'store' => 'admin.ledger-accounts.store',
    'show' => 'admin.ledger-accounts.show',
    'edit' => 'admin.ledger-accounts.edit',
    'update' => 'admin.ledger-accounts.update',
    'destroy' => 'admin.ledger-accounts.destroy',
]);

Route::get('/ledger-accounts/ajax/filter', [LedgerAccountController::class, 'ajaxFilter'])->name('admin.ledger-accounts.ajax.filter');


Route::get('/container/add-container', [ContainerController::class, 'add_container']);
Route::get('/container/filter', [ContainerController::class, 'filter']);
Route::post('/container/import', [ContainerController::class, 'import'])->name('container.import');
Route::resource('container', ContainerController::class)->except('destroy');
Route::post('/container/{id}/destroy', [ContainerController::class, 'destroy'])->name('container.destroy');
Route::put('/container/{id}/accept', [ContainerController::class, 'accept'])->name('container.accept');
Route::put('/container/{id}/reject', [ContainerController::class, 'reject'])->name('container.reject');
Route::post('/container/{id}/add-images', [ContainerController::class, 'add_images'])->name('container.add-images');

Route::get('/container-price/filter', [ContainerPriceController::class, 'filter'])->name('container-price.filter');
Route::resource('container-price', ContainerPriceController::class)->except('destroy', 'update');
Route::post('/container-price/{id}/update', [ContainerPriceController::class, 'update'])->name('container-price.update');
Route::get('/container-price/{id}/destroy', [ContainerPriceController::class, 'destroy'])->name('container-price.destroy');
Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
Route::put('/accounts/{account}', [AccountController::class, 'update'])->name('accounts.update');

Route::get('/booking/report', [BookingController::class, 'report'])->name('booking.report');

Route::resource('abandoned-cargo', AbandonedCargoController::class)->except('destroy');
Route::get('/abandoned-cargo/{id}/destroy', [AbandonedCargoController::class, 'destroy'])->name('abandoned-cargo.destroy');

Route::get('customer/add-person', [CustomerController::class, 'add_person']);
Route::resource('customer', CustomerController::class)->except('destroy');
Route::post('/customer/{id}/destroy', [CustomerController::class, 'destroy'])->name('customer.destroy');
Route::post('/customer/{id}/change-status', [CustomerController::class, 'change_status']);
Route::get('/customer/{id}/detail', [CustomerController::class, 'detail'])->name('customer.detail');
Route::post('/customer/import', [CustomerController::class, 'import'])->name('customer.import');

Route::resource('company', CompanyController::class)->except('destroy');
Route::get('/company/{id}/destroy', [CompanyController::class, 'destroy'])->name('company.destroy');
Route::post('/company/{id}/change-status', [CompanyController::class, 'change_status']);

Route::post('/booking-date/import', [BookingDateController::class, 'import'])->name('booking-date.import');
Route::post('/booking-date/update-cheking-containers', [BookingDateController::class, 'update_checking_containers'])->name('booking-date.update-checking');
Route::post('/booking-date/update-booking-date', [BookingDateController::class, 'update_booking_date'])->name('booking-date.update-booking-date');
Route::get('/booking-date/get-container-price', [BookingDateController::class, 'get_container_price']);
Route::resource('booking-date', BookingDateController::class)->except('destroy');
Route::post('/booking-date/{id}/destroy', [BookingDateController::class, 'destroy'])->name('booking-date.destroy');
Route::post('/booking-date/{id}/change-status', [BookingDateController::class, 'change_status'])->name('booking-date.change-status');
Route::get('/booking-date/{id}/get-status-info', [BookingDateController::class, 'get_status_info']);
Route::post('/booking-date/{id}/add-check', [BookingDateController::class, 'add_check']);
Route::get('/booking-date/{id}/detail', [BookingDateController::class, 'detail'])->name('booking-date.detail');

Route::get('/order-service/add-service', [OrderServiceController::class, 'add_service']);
Route::resource('order-service', OrderServiceController::class)->except('destroy');
Route::get('/order-service/{id}/destroy', [OrderServiceController::class, 'destroy'])->name('order-service.destroy');
Route::get('/order-service/{id}/get-service-details', [OrderServiceController::class, 'get_service_details']);
Route::get('/order-service/{id}/get-expense-types', [OrderServiceController::class, 'get_expense_types']);

Route::get('/booking-container', [BookingContainerController::class, 'index'])->name('booking-container.index');
Route::get('/booking-container/{date}/detail', [BookingContainerController::class, 'detail'])->name('booking-container.detail');
Route::post('/booking-container/{id}/change-status', [BookingContainerController::class, 'change_status']);
Route::post('/booking-container/{id}/pay', [BookingContainerController::class, 'pay'])->name('booking-container.pay');

Route::get('/user/add-user', [UserController::class, 'add_user']);
Route::resource('user', UserController::class)->except('destroy');
Route::get('/user/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
Route::post('/user/{id}/change-status', [UserController::class, 'change_status']);
Route::post('/user/{id}/assign-role', [UserController::class, 'assign_role'])->name('user.assign-role');

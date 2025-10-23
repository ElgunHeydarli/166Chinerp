<?php

use App\Http\Controllers\Admin\Setting\AboutBookingDateController;
use App\Http\Controllers\Admin\Setting\BranchController;
use App\Http\Controllers\Admin\Setting\CarTypeController;
use App\Http\Controllers\Admin\Setting\CityController;
use App\Http\Controllers\Admin\Setting\ContainerCheckReasonController;
use App\Http\Controllers\Admin\Setting\ContainerTypeController;
use App\Http\Controllers\Admin\Setting\CountryController;
use App\Http\Controllers\Admin\Setting\CurrencyController;
use App\Http\Controllers\Admin\Setting\CustomsClearanceController;
use App\Http\Controllers\Admin\Setting\DistrictController;
use App\Http\Controllers\Admin\Setting\DocumentTypeController;
use App\Http\Controllers\Admin\Setting\EducationController;
use App\Http\Controllers\Admin\Setting\ExpenseCategoryController;
use App\Http\Controllers\Admin\Setting\ExpenseSubCategoryController;
use App\Http\Controllers\Admin\Setting\ExpenseTypeController;
use App\Http\Controllers\Admin\Setting\IncotermController;
use App\Http\Controllers\Admin\Setting\MixFullController;
use App\Http\Controllers\Admin\Setting\PaymentTermController;
use App\Http\Controllers\Admin\Setting\PaymentTypeController;
use App\Http\Controllers\Admin\Setting\PermissionController;
use App\Http\Controllers\Admin\Setting\ProductTypeController;
use App\Http\Controllers\Admin\Setting\RejectReasonController;
use App\Http\Controllers\Admin\Setting\RoleController;
use App\Http\Controllers\Admin\Setting\SectorController;
use App\Http\Controllers\Admin\Setting\ServiceController;
use App\Http\Controllers\Admin\Setting\SourceController;
use App\Http\Controllers\Admin\Setting\StationController;
use App\Http\Controllers\Admin\Setting\StatusController;
use App\Http\Controllers\Admin\Setting\TransportationController;
use App\Http\Controllers\Admin\Setting\TransportationServiceController;
use App\Http\Controllers\Admin\Setting\TransportationTypeController;
use App\Http\Controllers\Admin\Setting\WarehouseController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::post('/incoterm/sort', [IncotermController::class, 'sort'])->name('incoterm.sort');
Route::resource('incoterm', IncotermController::class)->except('destroy');
Route::get('/incoterm/{id}/destroy', [IncotermController::class, 'destroy'])->name('incoterm.destroy');

Route::post('/container-type/sort', [ContainerTypeController::class, 'sort'])->name('container-type.sort');
Route::resource('container-type', ContainerTypeController::class)->except('destroy');
Route::get('/container-type/{id}/destroy', [ContainerTypeController::class, 'destroy'])->name('container-type.destroy');
Route::get('/container-type/{id}/get-containers', [ContainerTypeController::class, 'get_containers']);

Route::post('/customs-clearance/sort', [CustomsClearanceController::class, 'sort'])->name('customs-clearance.sort');
Route::resource('customs-clearance', CustomsClearanceController::class)->except('destroy');
Route::get('/customs-clearance/{id}/destroy', [CustomsClearanceController::class, 'destroy'])->name('customs-clearance.destroy');

Route::post('/reject-reason/sort', [RejectReasonController::class, 'sort'])->name('reject-reason.sort');
Route::resource('reject-reason', RejectReasonController::class)->except('destroy');
Route::get('/reject-reason/{id}/destroy', [RejectReasonController::class, 'destroy'])->name('reject-reason.destroy');

Route::post('/warehouse/sort', [WarehouseController::class, 'sort'])->name('warehouse.sort');
Route::resource('warehouse', WarehouseController::class)->except('destroy');
Route::get('/warehouse/{id}/destroy', [WarehouseController::class, 'destroy'])->name('warehouse.destroy');

Route::post('/container-check-reason/sort', [ContainerCheckReasonController::class, 'sort'])->name('container-check-reason.sort');
Route::resource('container-check-reason', ContainerCheckReasonController::class)->except('destroy');
Route::get('/container-check-reason/{id}/destroy', [ContainerCheckReasonController::class, 'destroy'])->name('container-check-reason.destroy');

Route::post('/currency/sort', [CurrencyController::class, 'sort'])->name('currency.sort');
Route::resource('currency', CurrencyController::class)->except('destroy');
Route::post('/currency/{id}/change-status', [CurrencyController::class, 'change_status']);
Route::get('/currency/{id}/destroy', [CurrencyController::class, 'destroy'])->name('currency.destroy');

Route::post('/transportation-type/sort', [TransportationTypeController::class, 'sort'])->name('transportation-type.sort');
Route::resource('transportation-type', TransportationTypeController::class)->except('destroy');
Route::get('/transportation-type/{id}/destroy', [TransportationTypeController::class, 'destroy'])->name('transportation-type.destroy');
Route::get('/transportation-type/{id}/get-transportation-services', [TransportationTypeController::class, 'get_transportation_services']);

Route::post('/transportation-service/sort', [TransportationServiceController::class, 'sort'])->name('transportation-service.sort');
Route::resource('transportation-service', TransportationServiceController::class)->except('destroy');
Route::get('/transportation-service/{id}/destroy', [TransportationServiceController::class, 'destroy'])->name('transportation-service.destroy');
Route::get('/transportation-service/{id}/get-transportations', [TransportationServiceController::class, 'get_transportations']);

Route::post('/transportation/sort', [TransportationController::class, 'sort'])->name('transportation.sort');
Route::resource('transportation', TransportationController::class)->except('destroy');
Route::get('/transportation/{id}/destroy', [TransportationController::class, 'destroy'])->name('transportation.destroy');

Route::post('/city/sort', [CityController::class, 'sort'])->name('city.sort');
Route::resource('city', CityController::class)->except('destroy');
Route::get('/city/{id}/destroy', [CityController::class, 'destroy'])->name('city.destroy');

Route::post('/branch/sort', [BranchController::class, 'sort'])->name('branch.sort');
Route::resource('branch', BranchController::class)->except('destroy');
Route::get('/branch/{id}/destroy', [BranchController::class, 'destroy'])->name('branch.destroy');

Route::post('/education/sort', [EducationController::class, 'sort'])->name('education.sort');
Route::resource('education', EducationController::class)->except('destroy');
Route::get('/education/{id}/destroy', [EducationController::class, 'destroy'])->name('education.destroy');

Route::post('/country/sort', [CountryController::class, 'sort'])->name('country.sort');
Route::resource('country', CountryController::class)->except('destroy');
Route::get('/country/{id}/destroy', [CountryController::class, 'destroy'])->name('country.destroy');

Route::post('/district/sort', [DistrictController::class, 'sort'])->name('district.sort');
Route::resource('district', DistrictController::class)->except('destroy');
Route::get('/district/{id}/destroy', [DistrictController::class, 'destroy'])->name('district.destroy');

Route::resource('about-booking-date', AboutBookingDateController::class)->except('destroy');
Route::get('/about-booking-date/{id}/destroy', [AboutBookingDateController::class, 'destroy'])->name('about-booking-date.destroy');

Route::post('/product-type/sort', [ProductTypeController::class, 'sort'])->name('product-type.sort');
Route::resource('product-type', ProductTypeController::class)->except('destroy');
Route::get('/product-type/{id}/destroy', [ProductTypeController::class, 'destroy'])->name('product-type.destroy');

Route::post('/payment-type/sort', [PaymentTypeController::class, 'sort'])->name('payment-type.sort');
Route::resource('payment-type', PaymentTypeController::class)->except('destroy');
Route::get('/payment-type/{id}/destroy', [PaymentTypeController::class, 'destroy'])->name('payment-type.destroy');

Route::post('/expense-type/sort', [ExpenseTypeController::class, 'sort'])->name('expense-type.sort');
Route::resource('expense-type', ExpenseTypeController::class)->except('destroy');
Route::get('/expense-type/{id}/destroy', [ExpenseTypeController::class, 'destroy'])->name('expense-type.destroy');

Route::post('/expense-category/sort', [ExpenseCategoryController::class, 'sort'])->name('expense-category.sort');
Route::resource('expense-category', ExpenseCategoryController::class)->except('destroy');
Route::get('/expense-category/{id}/destroy', [ExpenseCategoryController::class, 'destroy'])->name('expense-category.destroy');
Route::get('/expense-category/{id}/get-sub-categories', [ExpenseCategoryController::class, 'get_sub_categories']);

Route::post('/expense-sub-category/sort', [ExpenseSubCategoryController::class, 'sort'])->name('expense-sub-category.sort');
Route::resource('expense-sub-category', ExpenseSubCategoryController::class)->except('destroy');
Route::get('/expense-sub-category/{id}/destroy', [ExpenseSubCategoryController::class, 'destroy'])->name('expense-sub-category.destroy');

Route::post('/price-type/sort', [ExpenseTypeController::class, 'sort'])->name('price-type.sort');
Route::resource('price-type', ExpenseTypeController::class)->except('destroy');
Route::get('/price-type/{id}/destroy', [ExpenseTypeController::class, 'destroy'])->name('price-type.destroy');

Route::post('/payment-term/sort', [PaymentTermController::class, 'sort'])->name('payment-term.sort');
Route::resource('payment-term', PaymentTermController::class)->except('destroy');
Route::get('/payment-term/{id}/destroy', [PaymentTermController::class, 'destroy'])->name('payment-term.destroy');

Route::post('/station/sort', [StationController::class, 'sort'])->name('station.sort');
Route::resource('station', StationController::class)->except('destroy');
Route::get('/station/{id}/destroy', [StationController::class, 'destroy'])->name('station.destroy');

Route::post('/source/sort', [SourceController::class, 'sort'])->name('source.sort');
Route::resource('source', SourceController::class)->except('destroy');
Route::get('/source/{id}/destroy', [SourceController::class, 'destroy'])->name('source.destroy');

Route::post('/status/sort', [StatusController::class, 'sort'])->name('status.sort');
Route::resource('status', StatusController::class)->except('destroy');
Route::get('/status/{id}/destroy', [StatusController::class, 'destroy'])->name('status.destroy');

Route::post('/mix-full/sort', [MixFullController::class, 'sort'])->name('mix-full.sort');
Route::resource('mix-full', MixFullController::class)->except('destroy');
Route::get('/mix-full/{id}/destroy', [MixFullController::class, 'destroy'])->name('mix-full.destroy');

Route::post('/car-type/sort', [CarTypeController::class, 'sort'])->name('car-type.sort');
Route::resource('car-type', CarTypeController::class)->except('destroy');
Route::get('/car-type/{id}/destroy', [CarTypeController::class, 'destroy'])->name('car-type.destroy');

Route::post('/document-type/sort', [DocumentTypeController::class, 'sort'])->name('document-type.sort');
Route::resource('document-type', DocumentTypeController::class)->except('destroy');
Route::get('/document-type/{id}/destroy', [DocumentTypeController::class, 'destroy'])->name('document-type.destroy');

Route::post('/sector/sort', [SectorController::class, 'sort'])->name('sector.sort');
Route::resource('sector', SectorController::class)->except('destroy');
Route::get('/sector/{id}/destroy', [SectorController::class, 'destroy'])->name('sector.destroy');

Route::post('/service/sort', [ServiceController::class, 'sort'])->name('service.sort');
Route::resource('service', ServiceController::class)->except('destroy');
Route::get('/service/{id}/destroy', [ServiceController::class, 'destroy'])->name('service.destroy');

Route::get('/setting/filter', [SettingController::class, 'filter']);
Route::resource('setting', SettingController::class)->except('destroy');
Route::get('/setting/{id}/destroy', [SettingController::class, 'destroy'])->name('setting.destroy');

Route::post('/role/sort', [RoleController::class, 'sort'])->name('role.sort');
Route::resource('role', RoleController::class)->except('destroy');
Route::get('/role/{id}/destroy', [RoleController::class, 'destroy'])->name('role.destroy');
Route::post('/role/{id}/change-status', [RoleController::class, 'change_status']);
Route::get('/role/{id}/assign-permission', [RoleController::class, 'assign_permission'])->name('role.assign-permission');
Route::post('/role/{id}/assign-permission', [RoleController::class, 'assign_permission_post']);

Route::post('/permission/sort', [PermissionController::class, 'sort'])->name('permission.sort');
Route::resource('permission', PermissionController::class)->except('destroy');
Route::get('/permission/{id}/destroy', [PermissionController::class, 'destroy'])->name('permission.destroy');
Route::post('/permission/{id}/change-status', [PermissionController::class, 'change_status']);

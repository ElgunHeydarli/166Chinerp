<?php

use App\Http\Controllers\Admin\Account\AccountantBookController;
use App\Http\Controllers\Admin\Account\AccountController;
use App\Http\Controllers\Admin\Account\BulkPaymentController;
use App\Http\Controllers\Admin\Account\ExpenseController;
use App\Http\Controllers\Admin\Account\PaymentHistoryController;
use App\Http\Controllers\Admin\Account\ReceiveController;
use App\Http\Controllers\Admin\Account\SalaryController;
use App\Http\Controllers\Admin\Account\SalaryManagementController;
use App\Http\Controllers\Admin\LedgerAccountController;
use Illuminate\Support\Facades\Route;

Route::get('/salary/filter', [SalaryController::class, 'filter']);
Route::resource('salary', SalaryController::class)->except('destroy');
Route::get('/salary/{id}/destroy', [SalaryController::class, 'destroy'])->name('salary.destroy');

Route::get('/salary-management/filter', [SalaryManagementController::class, 'filter']);
Route::resource('salary-management', SalaryManagementController::class)->except('destroy');
Route::get('/salary-management/{id}/destroy', [SalaryManagementController::class, 'destroy'])->name('salary-management.destroy');
Route::get('/salary-management/{id}/payment', [SalaryManagementController::class, 'payment'])->name('salary-management.payment');
Route::post('/salary-management/{id}/payment', [SalaryManagementController::class, 'pay']);

Route::get('/payment-history/filter', [PaymentHistoryController::class, 'filter']);
Route::get('/payment-history', [PaymentHistoryController::class, 'index'])->name('payment-history.index');
Route::get('/payment-history/{date}/detail', [PaymentHistoryController::class, 'detail'])->name('payment-history.detail');

Route::get('/bulk-payment/filter', [BulkPaymentController::class, 'filter']);
Route::get('/bulk-payment', [BulkPaymentController::class, 'index'])->name('bulk-payment.index');

Route::get('/expense/account-payable', [AccountController::class, 'index'])->name('account-payable.index');
Route::get('/expense/pending', [AccountController::class, 'pending'])->name('account.pending');
Route::get('/expense/summary', [AccountController::class, 'summary'])->name('account.summary');

Route::get('/expense/filter', [ExpenseController::class, 'filter']);
Route::resource('expense', ExpenseController::class)->except('destroy');
Route::get('/expense/{id}/destroy', [ExpenseController::class, 'destroy'])->name('expense.destroy');
Route::post('/expense/{id}/pay', [ExpenseController::class, 'pay'])->name('expense.pay');

Route::get('/receive/filter', [ReceiveController::class, 'filter']);
Route::get('/receive/history', [ReceiveController::class, 'history'])->name('receive.history');
Route::get('/receive/history/filter', [ReceiveController::class, 'history_filter']);
Route::get('/receive/report', [ReceiveController::class, 'report'])->name('receive.report');
Route::get('/receive/report/filter', [ReceiveController::class, 'report_filter']);
Route::resource('/receive', ReceiveController::class)->except('destroy');
Route::get('/receive/{id}/destroy', [ReceiveController::class, 'destroy'])->name('receive.destroy');
Route::post('/receive/{id}/pay', [ReceiveController::class, 'pay'])->name('receive.pay');

Route::resource('ledger-accounts', LedgerAccountController::class);
Route::get('/accountant-book', [AccountantBookController::class, 'index'])->name('accountant-book.index');
Route::get('/accountant-book/{id?}/detail', [AccountantBookController::class, 'detail'])->name('accountant-book.detail');

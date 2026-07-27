<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\GminaApiController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/regulamin', [LegalController::class, 'terms'])->name('legal.terms');
Route::get('/polityka-prywatnosci', [LegalController::class, 'privacy'])->name('legal.privacy');

Route::post('/wyslij',[FormController::class,'submitToBitrix'])->name('form.submit');

Route::get('/potwierdz/{token}', [FormController::class, 'verifyLink'])->name('verification.verify');

Route::get('/api/gminy', [GminaApiController::class, 'search'])->name('api.gminy');
Route::get('/api/powiaty', [GminaApiController::class, 'powiaty'])->name('api.powiaty');
Route::get('/api/gminy-list', [GminaApiController::class, 'gminy'])->name('api.gminy.list');

Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/leady', [AdminController::class, 'index'])->name('leads');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::post('/leady/{lead}/accept', [AdminController::class, 'accept'])->name('leads.accept');
    Route::post('/leady/{lead}/reject', [AdminController::class, 'reject'])->name('leads.reject');
    Route::post('/leady/{lead}/status', [AdminController::class, 'updateStatus'])->name('leads.update-status');
});

Route::middleware('admin')->get('/admin/check-gmina', [AdminController::class, 'checkGmina'])->name('admin.leads.check-gmina');

Route::prefix('platnosci/przelewy24')->name('payments.przelewy24.')->group(function () {
    Route::post('/start', [PaymentController::class, 'start'])->name('start');
    Route::get('/powrot', [PaymentController::class, 'return'])->name('return');
    Route::post('/status', [PaymentController::class, 'status'])->name('status');
});

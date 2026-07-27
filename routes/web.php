<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\GminaApiController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/regulamin', [LegalController::class, 'terms'])->name('legal.terms');
Route::get('/polityka-prywatnosci', [LegalController::class, 'privacy'])->name('legal.privacy');

Route::post('/wyslij', [FormController::class, 'submitToBitrix'])->name('form.submit');
Route::get('/potwierdz/{token}', [FormController::class, 'verifyLink'])->name('verification.verify');

Route::get('/api/gminy', [GminaApiController::class, 'search'])->name('api.gminy');
Route::get('/api/powiaty', [GminaApiController::class, 'powiaty'])->name('api.powiaty');
Route::get('/api/gminy-list', [GminaApiController::class, 'gminy'])->name('api.gminy.list');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/admin/login', fn() => redirect()->route('login'));
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin,handlowiec'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/leady', [AdminController::class, 'index'])->name('leads');
    Route::get('/leady/dodaj', [LeadController::class, 'create'])->name('leads.create');
    Route::post('/leady', [LeadController::class, 'store'])->name('leads.store');
    Route::get('/leady/{lead}', [AdminController::class, 'show'])->name('leads.show');
    Route::put('/leady/{lead}', [AdminController::class, 'updateLead'])->name('leads.update');
    Route::post('/leady/{lead}/komentarz', [AdminController::class, 'addComment'])->name('leads.comment');
    Route::post('/leady/{lead}/status', [AdminController::class, 'updateStatus'])->name('leads.update-status');
    Route::post('/leady/{lead}/przypisz', [AdminController::class, 'assign'])->name('leads.assign');
    Route::get('/check-gmina', [AdminController::class, 'checkGmina'])->name('leads.check-gmina');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/uzytkownicy', [AdminController::class, 'userList'])->name('users');
    Route::get('/uzytkownicy/nowy', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/uzytkownicy', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/uzytkownicy/{user}/edytuj', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/uzytkownicy/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/uzytkownicy/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
});

Route::prefix('platnosci/przelewy24')->name('payments.przelewy24.')->group(function () {
    Route::post('/start', [PaymentController::class, 'start'])->name('start');
    Route::get('/powrot', [PaymentController::class, 'return'])->name('return');
    Route::post('/status', [PaymentController::class, 'status'])->name('status');
});

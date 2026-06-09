<?php

use App\Http\Controllers\FormController;
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

Route::prefix('platnosci/przelewy24')->name('payments.przelewy24.')->group(function () {
    Route::post('/start', [PaymentController::class, 'start'])->name('start');
    Route::get('/powrot', [PaymentController::class, 'return'])->name('return');
    Route::post('/status', [PaymentController::class, 'status'])->name('status');
});

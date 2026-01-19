<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/wyslij',[FormController::class,'submitToBitrix'])->name('form.submit');

Route::get('/weryfikuj', [FormController::class, 'showVerifyPage'])->name('otp.verify.page');

Route::post('/weryfikuj', [FormController::class, 'verifyOtp'])->name('otp.verify.submit');

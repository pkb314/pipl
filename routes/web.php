<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/wyslij',[FormController::class,'submitToBitrix'])->name('form.submit');


Route::get('/potwierdz/{token}', [FormController::class, 'verifyLink'])->name('verification.verify');

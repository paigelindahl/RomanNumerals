<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DateConversionController;

Route::get('/', function () {
    return view('app');
})->name('home');
Route::post('/convert-date', [DateConversionController::class, 'convertDate']);

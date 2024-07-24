<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DateConversionController;

Route::get('/', function () {
    return view('app');
})->name('home');

Route::controller(DateConversionController::class)->group(function () {
    Route::post('/convert-date', 'convertDateToRoman')->name('convert.toRoman');
    Route::post('/convert-numerals', 'convertRomanToDate')->name('convert.toDate');
});

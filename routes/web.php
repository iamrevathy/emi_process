<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
Route::get('/loan-details', 'LoanDetailsController@index')->name('loan-details');
Route::get('/process-save', 'ProcessController@processData')->name('process.save');
Route::get('/process-data', function () {
    return view('process-data');
})->name('process.data');


});

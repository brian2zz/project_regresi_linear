<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\datasetController;
use App\Http\Controllers\forecastingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [dashboardController::class, 'index']);

Route::get('/urea', [datasetController::class, 'index']);
Route::post('/urea', [datasetController::class, 'store']);
Route::get('/phonska', [datasetController::class, 'phonska']);
Route::post('/phonska', [datasetController::class, 'store']);
Route::get('/get-data/{selectedValue}', [datasetController::class, 'getData']);
Route::get('/get-data-all/{selectedValue}', [dashboardController::class, 'getDataAll']);
Route::get('/get-ket', [datasetController::class, 'getKet']);
Route::get('/forecasting', [forecastingController::class, 'index']);
Route::post('/forecasting', [forecastingController::class, 'forecast']);
Route::get('/history-forecasting', [forecastingController::class, 'viewHistory']);
Route::get('/get-history-forecasting', [forecastingController::class, 'hasilForecast']);

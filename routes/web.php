<?php

use App\Http\Controllers\datasetController;
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

Route::get('/', function () {
    return view('pages.dashboard.index');
});

Route::get('/dataset', [datasetController::class, 'index']);
Route::post('/dataset', [datasetController::class, 'store']);
Route::get('/get-data/{selectedValue}', [datasetController::class, 'getData']);
Route::get('/forecasting', function () {
    return view('pages.forecasting.index');
});

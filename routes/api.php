<?php

use App\Http\Controllers\RecyclerListController;
use App\Http\Controllers\RecyclerThemesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/get', [RecyclerListController::class, 'index']);
Route::post('/create', [RecyclerListController::class, 'create']);
Route::post('/update', [RecyclerListController::class, 'update']);
Route::post('/delete', [RecyclerListController::class, 'delete']);

Route::get('/getTheme', [RecyclerThemesController::class, 'index']);
Route::post('/createTheme', [RecyclerThemesController::class, 'create']);
Route::post('/updateTheme', [RecyclerThemesController::class, 'update']);
Route::post('/deleteTheme', [RecyclerThemesController::class, 'delete']);

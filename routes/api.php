<?php

use App\Http\Controllers\RclRepairController;
use App\Http\Controllers\RecyclerListController;
use App\Http\Controllers\RecyclerSolutionsController;
use App\Http\Controllers\RecyclerThemesController;
use App\Http\Controllers\UsersController;
use App\Models\RclRepair;
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
Route::post('/submit', [RecyclerListController::class, 'submit']);

Route::get('/getTheme', [RecyclerThemesController::class, 'index']);
Route::post('/createTheme', [RecyclerThemesController::class, 'create']);
Route::post('/updateTheme', [RecyclerThemesController::class, 'update']);
Route::post('/deleteTheme', [RecyclerThemesController::class, 'delete']);

Route::get('/getSolution', [RecyclerSolutionsController::class, 'index']);
Route::post('/createSolution', [RecyclerSolutionsController::class, 'create']);
Route::post('/updateSolution', [RecyclerSolutionsController::class, 'update']);
Route::post('/deleteSolution', [RecyclerSolutionsController::class, 'delete']);

Route::get('/getRepair', [RclRepairController::class, 'index']);
Route::post('/createRepair', [RclRepairController::class, 'create']);

Route::get('/getUser', [UsersController::class, 'index']);
Route::post('createUser', [UsersController::class, 'create']);
Route::post('updateUser', [UsersController::class, 'update']);
Route::post('deleteUser', [UsersController::class, 'delete']);


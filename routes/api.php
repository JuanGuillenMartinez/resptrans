<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SubsidiaryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('employees', EmployeeController::class);
Route::apiResource('subsidiaries', SubsidiaryController::class);
Route::apiResource('items', ItemController::class);

Route::post('subsidiaries/{id}/inventory', [SubsidiaryController::class, 'addItems']);
Route::get('subsidiaries/{id}/inventory', [SubsidiaryController::class, 'inventory']);
Route::delete('subsidiaries/{id}/inventory/{itemId}', [SubsidiaryController::class, 'removeItem']);
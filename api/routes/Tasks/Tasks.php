<?php

namespace Routes\Tasks;

use App\Http\Controllers\Tasks\CreateTaskController;
use App\Http\Controllers\Tasks\GetWidgetDataController;
use App\Http\Controllers\Tasks\ListTaskController;
use App\Http\Controllers\Tasks\UpdateTaskController;
use Illuminate\Support\Facades\Route;

Route::post('api/task/create', [CreateTaskController::class, '__invoke']);
Route::get('api/task/list', [ListTaskController::class, '__invoke']);
Route::put('api/task/update', [UpdateTaskController::class, '__invoke']);
Route::get('api/task/get-widget-data', [GetWidgetDataController::class, '__invoke']);
<?php

use App\Http\Controllers\UserController;

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

$router->get('users', [UserController::class, 'index']);
$router->post('users', [UserController::class, 'store']);
$router->get('users/{id}', [UserController::class, 'show']);
$router->put('users/{id}', [UserController::class, 'update']);
$router->delete('users/{id}', [UserController::class, 'destroy']);

<?php

use Illuminate\Http\Request;

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

// 登入並取得token
Route::post('sign', 'SignController@postSign');

// 取得所有權限
Route::get('permissions', 'PermissionController@getPermissions');

// 取得所有群組
Route::get('roles', 'PermissionController@getRoles');

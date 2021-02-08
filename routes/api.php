<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registerAccount', 'AppController@registerAccount');

Route::post('getList', 'AppController@getList');

Route::get('checkList', 'AccountController@checkList');

Route::post('addAccount', 'AccountController@addAccount');

Route::post('displayData', 'AccountController@displayData');

Route::post('updateData', 'AccountController@updateData');

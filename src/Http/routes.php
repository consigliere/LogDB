<?php

Route::group(['middleware' => 'web', 'prefix' => 'logdb', 'namespace' => 'App\\Components\LogDB\Http\Controllers'], function()
{
    Route::get('/', 'LogDBController@index');
});

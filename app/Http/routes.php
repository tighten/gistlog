<?php

Route::get('/', 'HomeController@index');

Route::post('posts/create', 'GistsController@storeAndRedirect');

Route::get('{userName}/{gistId}', 'GistsController@show');

<?php

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

Route::post('posts/create', 'GistsController@storeAndRedirect');

Route::get('{userName}/{gistId}', ['uses' => 'GistsController@show', 'as' => 'gists.show']);

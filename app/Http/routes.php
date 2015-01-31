<?php

Route::get('/', 'HomeController@index');

Route::post('posts/create', 'GistsController@storeAndRedirect');

Route::get('{userName}/{gistId}', ['uses' => 'GistsController@show', 'as' => 'gists.show']);

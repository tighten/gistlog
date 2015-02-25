<?php

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

Route::post('posts/create', 'GistsController@storeAndRedirect');

Route::get('{username}/{gistId}', ['uses' => 'GistsController@show', 'as' => 'gists.show']);

Route::get('{username}', ['uses' => 'AuthorsController@show', 'as' => 'authors.show']);

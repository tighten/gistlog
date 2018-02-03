<?php

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

Route::get('logout', 'Auth\AuthController@getLogout');
Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('posts/create', 'HomeController@createForm');
Route::post('posts/create', ['uses' => 'GistsController@storeAndRedirect', 'as' => 'post.create']);
Route::post('comment/{gistId}', ['middleware' => ['auth', 'csrf'], 'uses' => 'GistsController@postComment', 'as' => 'comments.store']);

Route::get('{username}/{gistId}', ['uses' => 'GistsController@show', 'as' => 'gists.show']);

Route::get('{username}', ['uses' => 'AuthorsController@show', 'as' => 'authors.show']);

Route::get('/test/test/gist-view', function () {
    return view('tailwind.gistlogs.show');
});

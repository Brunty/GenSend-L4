<?php

Route::get('/', 'HomeController@index');

Route::get('about', function() {
    return View::make('About.index');
});

Route::get('gen', 'GenerateController@index');
Route::post('gen', 'GenerateController@generate');

Route::get('send', 'SendController@index');
Route::post('send', 'SendController@store');

Route::get('v/{urlPart}', 'SendController@view');


Route::filter('testFilter', function()
{
    $tf = false;
    if($tf) {
        return Redirect::to('/');
    }
});
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/parsers', 'ParserController@index');
Route::post('/parsers/drom', 'ParserController@DromParser');
Route::get('/parsers/drom', 'ParserController@LinkToDrom');
Route::get('/parsers/cars', 'ParserController@CarsTable');
Route::post('/parsers/cars/{id}/translate', 'ParserController@CarTranslate');
Route::get('/parsers/cars/{id}', 'ParserController@CarPage');


/*
Route::get('/parsers/autodoc', 'ParserController@arpartsAutodoc');
Route::post('/parsers/autodoc', 'ParserController@arpartsAutodocParser');
Route::get('/parsers/drom', 'ParserController@DromParser');
Route::post('/parsers/drom', 'ParserController@arpartsDromParser');*/
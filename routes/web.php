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
//страница с выбором парсера
Route::get('/parsers', 'ParserController@index');
//страница парсера с Дром
Route::post('/parsers/drom', 'ParserController@DromParser');
Route::get('/parsers/drom', 'ParserController@LinkToDrom');
//страница с таблицей автомобилей
Route::get('/parsers/cars', 'ParserController@CarsTable');
Route::post('/parsers/cars/{id}/translate', 'ParserController@CarTranslate');
Route::get('/parsers/cars/{id}', 'ParserController@CarPage');
//страница с таблицей деталей
Route::get('/parsers/parts', 'ParserController@PartsTable');
Route::get('/parsers/parts/{id}', 'ParserController@IndexPartPage');
Route::post('/parsers/parts/{id}/edit', 'ParserController@PartEdit');
//Route::get('/parsers/parts/{id}/updatetranslation', 'ParserController@UpdateTranslation');
Route::get('/parsers/parts/{id}/delete', 'ParserController@PartDelete');
Route::get('/parsers/parts/{id}/edit', 'ParserController@PartPage');

Route::get('/parts/xml', 'ParserController@PartXML');
/*
Route::get('/parsers/autodoc', 'ParserController@arpartsAutodoc');
Route::post('/parsers/autodoc', 'ParserController@arpartsAutodocParser');
Route::get('/parsers/drom', 'ParserController@DromParser');
Route::post('/parsers/drom', 'ParserController@arpartsDromParser');*/



//Генератор страниц для Arparts
Route::get('/arparts', 'PageController@index');
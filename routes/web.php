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
    return redirect()->route('admin.home');
});

Auth::routes();

Route::get('admin/home', 'HomeController@index')->name('admin.home');
//страница с выбором парсера
Route::get('/parsers', 'ParserController@index');
//страница парсера с Дром
Route::post('/parsers/drom', 'ParserController@DromParser');
Route::get('admin/parsers/drom', 'ParserController@LinkToDrom')->name('parser.drom');
//страница с таблицей автомобилей
Route::get('/admin/cars-table', 'ParserController@CarsTable')->name('cars.table');
Route::post('/parsers/cars/{id}/translate', 'ParserController@CarTranslate')->name('car.translate');
Route::get('/parsers/cars/{id}', 'ParserController@CarPage')->name('car.page');
//страница с таблицей деталей
Route::get('admin/parts-table', 'ParserController@PartsTable')->name('parts.table');
Route::get('/admin/parts/{id}', 'ParserController@IndexPartPage')->name('part.page');
Route::post('/admin/parts/{id}/edit', 'ParserController@PartEdit')->name('part.edit');
//Route::get('/parsers/parts/{id}/updatetranslation', 'ParserController@UpdateTranslation');
Route::get('/admin/parts/{id}/delete', 'ParserController@PartDelete')->name('part.delete');
Route::get('/admin/parts/{id}/edit', 'ParserController@PartPage');

Route::get('/parts/xml', 'ParserController@PartXML')->name('xml');
/*
Route::get('/parsers/autodoc', 'ParserController@arpartsAutodoc');
Route::post('/parsers/autodoc', 'ParserController@arpartsAutodocParser');
Route::get('/parsers/drom', 'ParserController@DromParser');
Route::post('/parsers/drom', 'ParserController@arpartsDromParser');*/

//страница с таблицей ключевых слов
Route::get('admin/keywords-table', 'KeywordController@KeywordsTable')->name('keywords.table');
Route::post('admin/keywords/create-page/create', 'KeywordController@KeywordCreate')->name('keyword.create');
Route::get('admin/keywords/create-page', 'KeywordController@KeywordPageCreate')->name('keyword-page.create');
Route::get('admin/keywords/{id}', 'KeywordController@KeywordPage')->name('keyword.page');
Route::post('admin/keywords/{id}/edit', 'KeywordController@KeywordEdit')->name('keyword.edit');



//Генератор страниц для Arparts
Route::get('/arparts', 'PageController@index');
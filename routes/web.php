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
    //return redirect()->route('admin.home');
});

Auth::routes();

Route::get('admin/home', 'HomeController@index')->name('admin.home');
//страница с выбором парсера
Route::get('/parsers', 'ParserController@index');
//страница парсера с Дром
Route::post('/parsers/drom', 'ParserController@DromParser');
Route::post('/parsers/arpartsdrom', 'ParserController@OurDromParser')->name('parser.arparts.drom');
Route::post('/parsers/ourdrom', 'ParserController@OurTuningDromParser');
Route::get('admin/parsers/drom', 'ParserController@LinkToDrom')->name('parser.drom');
Route::get('admin/parsers/ourdrom', 'ParserController@LinkToOurDrom')->name('parser.our.drom');
Route::get('admin/parsers/our-tuning-drom', 'ParserController@LinkToOurTuningDrom')->name('our.tuning.drom.parser');
//страница с таблицей автомобилей
Route::get('/admin/cars-table', 'ParserController@CarsTable')->name('cars.table');
Route::post('/parsers/cars/{id}/translate', 'ParserController@CarTranslate')->name('car.translate');
Route::get('/parsers/cars/{id}', 'ParserController@CarPage')->name('car.page');
//страница с таблицей деталей
Route::get('admin/parts-table', 'ParserController@PartsTable')->name('parts.table');
Route::get('/admin/parts/{id}', 'ParserController@IndexPartPage')->name('part.page');
//Очистка окончания от *Подходит для большинства автомобилей! бла-бла-бла...*
Route::get('/admin/part/clearend', 'ParserController@ClearEnd')->name('part.clearend');
Route::post('/admin/parts/{id}/edit', 'ParserController@PartEdit')->name('part.edit');
//Route::get('/parsers/parts/{id}/updatetranslation', 'ParserController@UpdateTranslation');
Route::get('/admin/parts/{id}/delete', 'ParserController@PartDelete')->name('part.delete');
//Route::get('/admin/parts/{id}/edit', 'ParserController@PartPage');
Route::get('/admin/parts/{id}/part-to-shop/{shop}', 'ParserController@PartToShop')->name('part.to.shop');

Route::get('/admin/part/xml', 'ParserController@PartXML')->name('xml');
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

//страници с категориями
Route::get('admin/categories-table', 'CategoryController@CategoriesTable')->name('categories.table');
Route::post('admin/categories/create-page/create', 'CategoryController@CategoryCreate')->name('category.create');
Route::get('admin/categories/create-page', 'CategoryController@CategoryPageCreate')->name('category-page.create');
Route::get('admin/categories/{id}', 'CategoryController@CategoryPage')->name('category.page');
Route::post('admin/categories/{id}/edit', 'CategoryController@CategoryEdit')->name('category.edit');

//Товар в магазине
Route::get('admin/shops/{shop}/product-create-page', 'ProductController@ProductCreatePage')->name('product.create.page');
Route::post('admin/shops/{shop}/product-create-page/create', 'ProductController@ProductCreate')->name('product.create');
Route::get('admin/shops/{shop}/products', 'ProductController@ProductsTable')->name('products.table');
Route::get('admin/shops/{shop}/products/{product}', 'ProductController@ProductPage')->name('product.page');
Route::post('admin/shops/{shop}/products/{product}/edit', 'ProductController@ProductEdit')->name('product.edit');
Route::get('admin/shops/{shop}/products/{product}/delete', 'ProductController@ProductDelete')->name('product.delete');
Route::get('admin/shops/{shop}/products-xml', 'ProductController@ProductsXML')->name('products.xml');
//Магазин
Route::get('admin/shop-create-page', 'ShopController@ShopCreatePage')->name('shop.create.page');
Route::post('admin/shop-create-page/create', 'ShopController@ShopCreate')->name('shop.create');
Route::get('admin/shops', 'ShopController@ShopsTable')->name('shops.table');
Route::get('admin/shops/{shop}', 'ShopController@ShopPage')->name('shop.page');
Route::post('admin/shops/{shop}/edit', 'ShopController@ShopEdit')->name('shop.edit');
// Страница с таблицей ссылок на запчасти
Route::get('admin/shops/{shop}/partlink', 'ShopController@PartLinkPage')->name('shop.partlink-page');
// Страница добавления ссылки
Route::get('admin/shops/{shop}/partlink/add', 'ShopController@AddPartLinkPage')->name('shop.add-partlink-page');
// Роут добавления запчасти в магазин
Route::get('admin/shops/{shop}/partlink/{partlink}/add-to-shop', 'ShopController@AddToShopPartLink')->name('shop.add-to-shop-partlink');
// Роут добавления всех запчастей в магазин
Route::get('admin/shops/{shop}/all-partlink/add-to-shop', 'ShopController@AddToShopAllPartLink')->name('shop.add-to-shop-all-partlink');
// Роут создания ссылки
Route::post('admin/shop/{shop}/partlink/create', 'ShopController@CreatePartLinkPage')->name('shop.create-partlink-page');
// Страница получения XML с товарами
Route::get('admin/shops/{shop}/products-avito-xml', 'ShopController@AvitoXML')->name('shop.products-avito-xml');



//Генератор страниц для Arparts
Route::get('/arparts', 'PageController@index');

//Генератор страниц для Arparts
Route::get('/', 'PartController@MainPage')->name('shop.main.page');
Route::get('/all-parts', 'PartController@AllPartsPage')->name('shop.all.parts.page');
Route::get('/part/{part}', 'PartController@PartPage')->name('shop.part.page');
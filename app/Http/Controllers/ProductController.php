<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Part;
use App\Car;
use App\User;
use App\Shop;
use App\Product;
use App\Keyword;
use App\Category;
use App\ExtraWords;
use App\PartLink;
use Storage;
use File;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;


class ProductController extends Controller
{
    //Страница товара в магазине (в админке)
    public function ProductPage($shopId, $productId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$user = Auth::user()->id;
			$shop = Shop::find($shopId);
			$product = Product::findOrFail($productId);
			$models = $product->models;
			$cats = Category::get();
//			if ($product->category_id != NULL) {
//				$category = Category::find($product->category_id);
//				$nameOfCategory = $category->name;
//			}
//			else {
//				$nameOfCategory = "Категория не назначена";
//			}
			if ($models != NULL) {
				// получили данные
				$models = explode(',', $models); //создаем массив из моеделей авто
				$translations = array(); //пустой массив
				foreach ($models as $model) {
					$model = trim($model); //удаляем пробелы
					$car = Car::where('alias', $model)->first(); //находим тачку в таблице Автомобилей
					$translation = $car->title.' ('.$car->translate.')'; //получаем данные
					array_push ($translations, $translation); //добавляем данные в таблицу
				}
			}
			else {
				$translations = array();
			}
			if ($product->shop_id == $shop->id) {
				return view('admin.product-page', compact('shop', 'product', 'translations', 'cats'));
			}
			else {
				return redirect()->back();
			}
		}
		else {
			return redirect('/login');
		}
    }
	
	//Старинца создания товара в магазине (в админке)
    public function ProductCreatePage($shopId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			return view('admin.product-create-page', compact('shop'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Создание товара - роут
    public function ProductCreate($shopId, Request $request)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			//$shop_name = $request['name'];
			//$user_id = Auth::user()->id;
			$shop = Shop::find($shopId);
			$product = Product::create([
					'name' => $request['name'], 
					'price' => $request['price'],
					'description' => $request['description'],
					'meta' => $request['meta'],
					'shop_id' => $shop->id]);
			$product -> save();
			$models = $request['models']; //получаем значения моделей из request
			if ($models != NULL ) {
				$marks = explode(',', $models); //преобразуем в массив
				$alias_models = array(); //пустой массив для новых марок автомобилей
				foreach ($marks as $mark) {
					$alias = preg_replace("/ /","",$mark);
					//находим значение или создаем новое
					$tableCar = Car::firstOrNew([
													'alias' => $alias
													], [
													'title' => $mark,
													'translate' => ''
													]);
					$tableCar->save();
					array_push($alias_models, $alias); //добавляем в конец массива алиас модели
				}
				$product->models = implode(", ", $alias_models);
				$product->save();
			}
			$image = $request['image'];
			if ($image != NULL) {
				$image_name = 'pr_'.$product->id.'.jpg';
				if ($exists = Storage::disk('local')->exists('public/'.$image_name)) {
					Storage::disk('local')->delete('public/'.$image_name);
				}
				Storage::disk('local')->put('public/'.$image_name, File::get($image));
				$link = env('APP_URL').Storage::disk('local')->url('public/'.$image_name);
				$product->image=$link;
				$product->save();
			}
			return redirect()->route('products.table',['id' => $shop->id]);
		}
		else {
			return redirect('/login');
		}
    }
	
	//Изменить информацию о товаре - роут
    public function ProductEdit(Request $request, $shopId, $productId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$user = Auth::user()->id;
			$shop = Shop::find($shopId);
			$product = Product::findOrFail($productId);
			if ($product->shop_id == $shop->id) {
				$product->name=$request['name'];
				$product->price=$request['price'];
				$product->meta=$request['meta'];
				$product->category_id=$request['category'];
				$product->description=$request['description'];
				$models = $request['models']; //получаем значения моделей из request
				$marks = explode(',', $models); //преобразуем в массив
				$alias_models = array(); //пустой массив для новых марок автомобилей
				foreach ($marks as $mark) {
					$alias = preg_replace("/ /","",$mark);
					//находим значение или создаем новое
					$tableCar = Car::firstOrNew([
													'alias' => $alias
													], [
													'title' => $mark,
													'translate' => ''
													]);
					$tableCar->save();
					array_push($alias_models, $alias); //добавляем в конец массива алиас модели
				}
				$product->models = implode(", ", $alias_models);
				$product->save();
				
				$image = $request['image'];
				if ($image != NULL) {
					$image_name = 'pr_'.$product->id.'.jpg';
					if ($exists = Storage::disk('local')->exists('public/'.$image_name)) {
						Storage::disk('local')->delete('public/'.$image_name);
					}
					Storage::disk('local')->put('public/'.$image_name, File::get($image));
					$link = env('APP_URL').Storage::disk('local')->url('public/'.$image_name);
					$product->image=$link;
						$product->save();
				}
			}
			return redirect()->back();
		}
		else {
			return redirect('/login');
		}
    }
	
	//Удалить товар из магазина
    public function ProductDelete($shopId, $productId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$user = Auth::user();
			$shop = Shop::find($shopId);
			$product = Product::findOrFail($productId);
			if ($user -> type == 'admin') {
				if ($product->shop_id == $shop->id) {
					$exist = PartLink::where('link', $product->link)->count();
					if ($exist != 0) {
						$partlink = PartLink::where('link', $product->link)->first();
						$partlink->delete();
					}
					$product->delete();
					return redirect()->route('shop.page',['id' => $shop->id]);
				}
				else {
					return redirect()->back();
				}
			}
			else {
				return redirect()->back();
			}
		}
		else {
			return redirect('/login');
		}
    }
	
	//Страница со списком магазинов
    public function ProductsTable($shopId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			$products = Product::where('shop_id', $shop->id)->orderBy('created_at', 'desc')->get();
			return view('admin.products-table', compact('products', 'shop'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Получить XML файл с запчастями
    public function ProductsXML(Part $part, Car $car, $shopId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			$products = Product::where('shop_id', $shop->id)->orderBy('created_at', 'desc')->get();
			$categories = Category::get();
			return view('admin.products-xml', compact('products', 'collection', 'categories'));
		}
		else {
			return redirect('/login');
		}
    }
	
	// Очистить описание от ненужных слов
    public function clean($shopId, $productId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			// Нашли магазин
			$shop = Shop::find($shopId);
			// Нашли товар
			$product = Product::find($productId);
			// Взяли все слова
			$words = ExtraWords::where('shop_id', $shopId)->get();
			// Описание из информации о товаре
			$description = $product->description;
			// Название товара
			$title_of_product = $product->name;
			// Отобразили
			print($description).'<br>';
			// Для каждого слова из словаря
			foreach ($words as $word) {
				// Очистим его
				$text = trim($word->body);
				// Покажем 
				print($text).'<br>';
				// Если найдено соответствие в описании - удалить
				if (strpos($description, $text) !== false) {
					$description = str_replace($text, '', $description);
				}
				// Если найдено соответствие в названии - удалить
				if (strpos($title_of_product, $text) !== false) {
					$title_of_product = str_replace($text, '', $title_of_product);
				}
			}
			// Все применимости
			$models = $product->models;
			// Если они есть
			if ($models != NULL) {
				// Раделим по запятым
				$models = explode(',', $models);
				// Для каждой модели
				foreach ($models as $model) {
					// Очистим её
					$model = trim($model);
					// Найдем её в таблице
					$car = Car::where('alias', $model)->first();
					// Получим название
					$title = $car->title;
					// Если найдено соответствие - удалить
					if (strpos($description, $title) !== false) {
						$description = str_replace($title, '', $description);
					}
				}
			}
			// Покажем результат
			print($description);
			// Занемена в товар
			$product ->description = $description;
			// Занемена в товар
			$product ->name = $title_of_product;
			// Сохраним товар
			$product -> save();
			return redirect()->route('product.page',[$shop->id, $product->id]);
		}
		else {
			return redirect('/login');
		}
    }
	
	// Очистить описание от ненужных слов у всех товаров магазина
    public function cleanAll($shopId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			// Получаем магазин
			$shop = Shop::find($shopId);
			// Находим все товары
			$products = Product::where('shop_id', $shop->id)->get();
			// И все слова
			$words = ExtraWords::where('shop_id', $shop->id)->get();
			// Для каждого товара
			foreach ($products as $product) {
				// Напечатаем его номер
				print($product->id).'<br>';
				// Описание
				$description = $product->description;
				// Название товара
				$title_of_product = $product->name;
				// Тоже выведем
				print($description).'<br>';
				// Для каждого слова из словаря
				foreach ($words as $word) {
					// очистка
					$text = trim($word->body);
					// Вывод
					print($text).'<br>';
					// Удаляем ненужное
					if (strpos($description, $text) !== false) {
						$description = str_replace($text, '', $description);
					}
					// Если найдено соответствие в названии - удалить
					if (strpos($title_of_product, $text) !== false) {
						$title_of_product = str_replace($text, '', $title_of_product);
					}
				}
				// Тут все должно быть понятно
				$models = $product->models;
				if ($models != NULL) {
					$models = explode(',', $models);
					foreach ($models as $model) {
						$model = trim($model);
						$car = Car::where('alias', $model)->first();
						$title = $car->title;
						if (strpos($description, $title) !== false) {
							$description = str_replace($title, '', $description);
						}
					}
				}

				print($description);
				$product ->description = $description;
				// Занемена в товар
				$product ->name = $title_of_product;
				$product -> save();
			}
			return redirect()->route('shop.page', [$shop->id]);
		}
		else {
			return redirect('/login');
		}
    }
	
	// Присвоить начальное описание
    public function OriginalName($shopId, $productId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			// Нашли магазин
			$shop = Shop::find($shopId);
			// Нашли товар
			$product = Product::find($productId);
			// Добавляем в парсер
			$html = new \Htmldom($product->link);
			// Копируем название
			$title_promo=$html->find('h1.subject span', 0)->plaintext;
			// Занемена в товар
			$product ->name = $title_promo;
			// Сохраним товар
			$product -> save();
			return redirect()->route('product.page',[$shop->id, $product->id]);
		}
		else {
			return redirect('/login');
		}
    }
	
	// Присвоить начальное описание
    public function AllOriginalName($shopId, $startId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			// Нашли магазин
			$shop = Shop::find($shopId);
			// Находим все товары
			$products = Product::where('shop_id', $shop->id)->where('id', '>=', $startId)->get();
			// Функция под каждый товар
			foreach ($products as $product) {
				// Добавляем в парсер
				if ($product->link !== NULL) {
					print $product->id;
					print $product->name;
					$html = new \Htmldom($product->link);
					if (($html->find('h1.subject span', 0))) {
						// Копируем название
						$title_promo=$html->find('h1.subject span', 0)->plaintext;
						// Занемена в товар
						$product ->name = $title_promo;
						// Сохраним товар
						$product -> save();
					}
				}
			}
			return redirect()->route('shop.page',[$shop->id]);
		}
		else {
			return redirect('/login');
		}
    }
	
}

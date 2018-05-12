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
use App\PartLink;
use Storage;
use File;
use DateTime;

class ShopController extends Controller
{
    //Страница магазина в админке
    public function ShopPage($shopId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$user = Auth::user()->id;
			if (Auth::user()->type == 'admin') {
				$shop = Shop::find($shopId);
				$products = Product::where('shop_id',$shop->id)->orderBy('created_at', 'desc')->paginate(10);
				$parts = Part::orderBy('created_at', 'desc')->paginate(10);
				foreach ($parts as $part) {
					$models = $part->models;
					$models = explode(',', $models);
					$translations = array();
					foreach ($models as $model) {
						$model = trim($model);
						$car = Car::where('alias', $model)->first();
						$translation = $car->title.' ('.$car->translate.'),';
						array_push ($translations, $translation);
					}
					//array_splice($translations, 5);
					//print_r($translate);
				}
				return view('admin.shop-page', compact('shop','products', 'parts'));
			}
			else {
				return redirect()->back();
			}
		}
		else {
			return redirect('/login');
		}
    }
	
	//Старинца создания магазина
    public function ShopCreatePage()
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			return view('admin.shop-create-page');
		}
		else {
			return redirect('/login');
		}
    }
	
	//Старинца таблицы со ссылками
    public function PartLinkPage($shopId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			$links = PartLink::where('shop_id', $shopId)->orderBy('created_at', 'desc')->paginate(20);
			return view('admin.shop-partlink-page', compact('links', 'shop'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Старинца созадния ссылки на DROM
    public function AddPartLinkPage($shopId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			$description = 'Добавьте в поле ввода ссылку на магазин - https://baza.drom.ru/user/ARparts';
			$action = action('ShopController@CreatePartLinkPage', [$shop->id]);
			return view('admin.shop-add-partlink-page', compact('shop', 'action', 'description'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Добавления товара в магазин по ссылке на дром
    public function AddToShopPartLink($shopId, $partlinkId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			// Получаем id магазина
			$shop = Shop::find($shopId);
			// Находим ссылку на запчасть по id
			$partlink = PartLink::find($partlinkId);
			// Добавляем в парсер
			$html = new \Htmldom($partlink->link);
			// Копируем название
            $title_promo=$html->find('h1.subject span', 0)->plaintext;
			// Убираем все лишнее
			$title_promo=trim($title_promo);
			
			$preTitle3 = 'в Санкт-Петербурге';
			if (strpos($title_promo, $preTitle3) !== false) {
				$title_promo = str_replace($preTitle3, '', $title_promo);
			}
			
			print($title_promo);
			// Берем картинку
			$image=$html->find('link[rel="image_src"]', 0)->href;
			$image=substr($image,0,-10).'_bulletin.jpg';
			
			// Категория запчасти
			$types = array();
			$category_from_drom = '';
			$category = 999;
			foreach ($html->find('div[id=breadcrumbs] span') as $type) {
				$type=$type->plaintext;
				array_push($types, $type);
			}
			if ($types != NULL) {
				print_r($types);
				// Получаем последний элемент массива с категориями
				$category_from_drom = array_pop($types);
			}
			
			// Цена
			$price=$html->find('.viewbull-summary-price__value', 0)->plaintext;
			$price = substr($price,0,-4);
			$price = str_replace(" ","",$price);
			$price = (int) $price;
			$price_main = $price;
			if ($price<=5000) {
				$price = $price*1;
				$price = ceil($price/100) * 100;
			}
			else {
				$price = $price*1;
				$price = ceil($price/100) * 100;
			}
			print($price_main);
			$enginesToDB = '';
			$modelsToDB = '';
			$numbers = '';
			// Подсчет и отображение всех информационных полей
			foreach ($html->find('.fieldset div.field .label') as $i) {
				$name = $i->plaintext;
				print($name).':';
				if ($name == 'Номера в каталоге производителя') {
					$numbers = $html->find('span[data-field=autoPartsNumber]', 0)->plaintext;
					print($numbers).'<br>';
				}
				if ($name == 'Для моделей') {
					$models = array();
					foreach ($html->find('.autoPartsModel .inplace li') as $mark) {
						$mark = explode(',', $mark);
						$mark = str_replace("<li>","",$mark);
						$mark = str_replace("</li>","",$mark);
						$mark = $mark[0];
						$alias = preg_replace("/ /","",$mark);
						
						// Удаление окончания категории с названием модели
						// Находим соответствие, если оно есть, то удаляем
						if (strpos($category_from_drom, $mark) !== false) {
							$category_from_drom = str_replace($mark, '', $category_from_drom);
							$category_from_drom = Category::firstOrNew([
											'name' => trim($category_from_drom)
											], [
											]);
							$category_from_drom->save();
							$category = $category_from_drom->id;
							print($category_from_drom->name).'<br>';
						}
						
						// Найти в таблице название модели, если его нет, то создать
						$tableCar = Car::firstOrNew([
														'alias' => $alias
														], [
														'title' => $mark,
														'translate' => ''
														]);
						$tableCar->save();
						//$mark = $tableCar->title.' ('.$tableCar->translate.')'; //сгененрировать название
						array_push($models, $alias);
					}
					$models = array_unique($models);
					$modelsToDB = implode(", ",$models);
					print($modelsToDB);
				}
				if ($name == 'Для двигателей') {
					$engine=''; //пустое значение в массив
					$parsed_engine=$html->find('.autoPartsEngine span.inplace', 0)->plaintext; //парсим номера двигателей
					$engines = explode(', ', $parsed_engine); //разделяем их по зяпятой
					$enginesToDB = implode(", ", $engines); //Двигатели, которые пойдут в БД
					print($enginesToDB).'<br>';
				}
			}
			$description = $numbers;
			$meta = $enginesToDB;
			//Добавляем в БД
			$link = $partlink->link;
			$same = Product::where('shop_id', $shop->id)->where('link', $link)->count();
				if ($same == 0) {
					$product = Product::create([	
						'link' => $link,
						'shop_id' => $shop->id,
						'description' => $description,
						'models' => $modelsToDB,
						'category_id' => $category, 
						'name' => $title_promo, 
						'price' => $price_main,
						'meta' => $meta,
						'image' => $image]);
				}
			return redirect()->route('shop.page', [$shop->id]);
		}
		else {
			return redirect('/login');
		}
    }
	
	//Добавления товара в магазин по ссылке на дром
    public function AddToShopAllPartLink($shopId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			// Получаем id магазина
			$shop = Shop::find($shopId);
			$partlinks = PartLink::where('shop_id', $shop->id)->get();
			$n = 0;
			foreach ($partlinks as $partlink) {
				$exist = Product::where('shop_id', $shop->id)->where('link', $partlink->link)->count();
				if ($exist == 0) {
					// Добавляем в парсер
					$html = new \Htmldom($partlink->link);
					// Копируем название
					$title_promo=$html->find('h1.subject span', 0)->plaintext;
					// Убираем все лишнее
					$title_promo=trim($title_promo);

					$preTitle3 = 'в Санкт-Петербурге';
					if (strpos($title_promo, $preTitle3) !== false) {
						$title_promo = str_replace($preTitle3, '', $title_promo);
					}

					print($title_promo);
					// Берем картинку
					$image=$html->find('link[rel="image_src"]', 0)->href;
					$image=substr($image,0,-10).'_bulletin.jpg';

					// Категория запчасти
					$types = array();
					$category_from_drom = '';
					$category = 999;
					foreach ($html->find('div[id=breadcrumbs] span') as $type) {
						$type=$type->plaintext;
						array_push($types, $type);
					}
					if ($types != NULL) {
						print_r($types);
						// Получаем последний элемент массива с категориями
						$category_from_drom = array_pop($types);
					}

					// Цена
					$price=$html->find('.viewbull-summary-price__value', 0)->plaintext;
					$price = substr($price,0,-4);
					$price = str_replace(" ","",$price);
					$price = (int) $price;
					$price_main = $price;
					if ($price<=5000) {
						$price = $price*1;
						$price = ceil($price/100) * 100;
					}
					else {
						$price = $price*1;
						$price = ceil($price/100) * 100;
					}
					print($price_main);
					$enginesToDB = '';
					$modelsToDB = '';
					$numbers = '';
					// Подсчет и отображение всех информационных полей
					foreach ($html->find('.fieldset div.field .label') as $i) {
						$name = $i->plaintext;
						print($name).':';
						if ($name == 'Номера в каталоге производителя') {
							$numbers = $html->find('span[data-field=autoPartsNumber]', 0)->plaintext;
							print($numbers).'<br>';
						}
						if ($name == 'Для моделей') {
							$models = array();
							foreach ($html->find('.autoPartsModel .inplace li') as $mark) {
								$mark = explode(',', $mark);
								$mark = str_replace("<li>","",$mark);
								$mark = str_replace("</li>","",$mark);
								$mark = $mark[0];
								$alias = preg_replace("/ /","",$mark);

								// Удаление окончания категории с названием модели
								// Находим соответствие, если оно есть, то удаляем
								if (strpos($category_from_drom, $mark) !== false) {
									$category_from_drom = str_replace($mark, '', $category_from_drom);
									$category_from_drom = Category::firstOrNew([
													'name' => trim($category_from_drom)
													], [
													]);
									$category_from_drom->save();
									$category = $category_from_drom->id;
									print($category_from_drom->name).'<br>';
								}

								// Найти в таблице название модели, если его нет, то создать
								$tableCar = Car::firstOrNew([
																'alias' => $alias
																], [
																'title' => $mark,
																'translate' => ''
																]);
								$tableCar->save();
								//$mark = $tableCar->title.' ('.$tableCar->translate.')'; //сгененрировать название
								array_push($models, $alias);
							}
							$models = array_unique($models);
							$modelsToDB = implode(", ",$models);
							print($modelsToDB);
						}
						if ($name == 'Для двигателей') {
							$engine=''; //пустое значение в массив
							$parsed_engine=$html->find('.autoPartsEngine span.inplace', 0)->plaintext; //парсим номера двигателей
							$engines = explode(', ', $parsed_engine); //разделяем их по зяпятой
							$enginesToDB = implode(", ", $engines); //Двигатели, которые пойдут в БД
							print($enginesToDB).'<br>';
						}
					}
					$description = $numbers;
					$meta = $enginesToDB;
					//Добавляем в БД
					$link = $partlink->link;
					$same = Product::where('shop_id', $shop->id)->where('link', $link)->count();
						if ($same == 0) {
							$product = Product::create([	
								'link' => $link,
								'shop_id' => $shop->id,
								'description' => $description,
								'models' => $modelsToDB,
								'category_id' => $category, 
								'name' => $title_promo, 
								'price' => $price_main,
								'meta' => $meta,
								'image' => $image]);
						}
				}
				else {
					$n+=1;
					print('Запчасть уже есть, перехожу к следующей').$n.'<br>';
				}
			}
			return redirect()->route('shop.page', [$shop->id]);
		}
		else {
			return redirect('/login');
		}
    }
	
	//Создать ссылку на DROM
    public function CreatePartLinkPage($shopId, Request $request)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			
			$drompage = $request['html'];
			$startpage = $request['startpage'];
			$endpage = $request['endpage'];
			$i = 1;
			$b = 180;
			if ($startpage != NULL) {
				$i = $startpage;
			}
			if ($endpage != NULL && $endpage>=$startpage) {
				$b = $endpage;
			}
			while($i<=$b) {
				// Получем ссылку на магазин и добавляем в конце необходимое окончание
				$page_name =$drompage.'/sell_spare_parts/?page='.$i;
				// Отобразить ссылку
				print($page_name).'<br>';
					//Добавляем ссылку в парсер
					$page = new \Htmldom($page_name);
					// Для каждого элмента на странице
					foreach($page->find('tr.bull-item td.descriptionCell a') as $part) {
						// Ссылка это индекс href
						$link = $part->href;
						print($link).'<br>';
						// Название это текст в ссылке
						$title = $part->plaintext;
						print($title).'<br>';
						
						$same = PartLink::where('shop_id', $shop->id)->where('link', $link)->count();
						if ($same == 0) {
							$partlink = PartLink::create([
								'shop_id' =>$shop->id,
								'title' => $title, 
								'link' => $link]);
						}
					}
				// Переходим на сделующую страницу
				$i++;
			}
			return redirect()->route('shop.partlink-page', [$shop->id]);
		}
		else {
			return redirect('/login');
		}
    }
	
	//Создание магазина - роут
    public function ShopCreate(Request $request)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			//$shop_name = $request['name'];
			//$user_id = Auth::user()->id;
			$shop = Shop::create([
					'name' => $request['name'], 
					'user_id' => Auth::user()->id]);
			$shop -> save();
			return redirect()->route('shops.table');
		}
		else {
			return redirect('/login');
		}
    }
	
	//Изменить информацию о магазине - роут
    public function ShopEdit(Request $request, $shopId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			if ($shop->user_id == Auth::user()->id) {
				$shop->name=$request['name'];
				$shop->save();
				$image = $request['image'];
				if ($image != NULL) {
					$image_name = 's_'.$shop->id.'.jpg';
					if ($exists = Storage::disk('local')->exists('public/'.$image_name)) {
						Storage::disk('local')->delete('public/'.$image_name);
					}
					Storage::disk('local')->put('public/'.$image_name, File::get($image));
					$link = env('APP_URL').Storage::disk('local')->url('public/'.$image_name);
					$shop->image=$link;
						$shop->save();
				}
				return redirect()->back();
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
    public function ShopsTable()
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$shops = Shop::orderBy('created_at', 'desc')->get();
			return view('admin.shops-table', compact('shops'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Получить XML файл с запчастями
    public function AvitoXML($shopId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			$products = Product::where('shop_id', $shop->id)->orderBy('created_at', 'desc')->get();
			return view('admin.products-avito-xml', compact('shop','products'));
		}
		else {
			return redirect('/login');
		}
    }
}

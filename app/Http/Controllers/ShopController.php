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
use App\ExtraWords;
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
			
			$link = $partlink->link;
			$shop->parserStandart($link, $shop, $partlink);
			
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
					$link = $partlink->link;
					$shop->parserStandart($link, $shop, $partlink);
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
			$keyword = $request['keyword'];
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
				// если нет названия детали, значит парсим просто магазин
				if (strpos($drompage, 'sell_spare_parts') !== false) {
					if ($keyword !== NULL) {
						$page_name =$drompage.'/sell_spare_parts/?query='.$keyword.'&page='.$i;
					}
					else {
						$page_name =$drompage.'/sell_spare_parts/?page='.$i;
					}
				}
				// если в ссылке есть название детали, то парсим категорию с этой запчастью
				else {
					if ($keyword !== NULL) {
						$page_name =$drompage.'/sell_spare_parts/?query='.$keyword.'&page='.$i;
					}
					else {
						$page_name =$drompage.'/?page='.$i;
					}
				}
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
				$shop->information=$request['information'];
				$shop->additional_information=$request['additional_information'];
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
				$shop->save();
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

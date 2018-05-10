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
			$links = PartLink::where('shop_id', $shopId)->orderBy('created_at', 'desc')->get();
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
			$action = action('ShopController@CreatePartLinkPage', [$shop->id]);
			return view('admin.shop-add-partlink-page', compact('shop', 'action'));
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
			$i = 1;
			while($i<55) {
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
}

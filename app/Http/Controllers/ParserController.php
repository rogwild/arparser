<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Part;
use App\Car;
use App\User;
use App\Keyword;
use App\Category;
use App\Shop;
use App\Product;
use Storage;
use File;
use DateTime;

class ParserController extends Controller
{
    //Выбор парсера
    public function index(Request $request)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			return view('parser.chooseParser');
		}
		else {
			return redirect('/login');
		}
    }
	
	//Выбор парсера
    public function LinkToDrom()
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$page_name = 'DROM.RU';
			$link = 'baza.drom.ru';
			$action = action('ParserController@DromParser');
			return view('admin.parts-parser', compact('page_name', 'link', 'action'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Выбор парсера
    public function LinkToOurDrom()
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$page_name = 'DROM.RU (страница Arparts, наценка производиться не будет)';
			$link = 'baza.drom.ru';
			$action = action('ParserController@OurDromParser');
			return view('admin.parts-parser', compact('page_name', 'link', 'action'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Выбор парсера
    public function LinkToOurTuningDrom()
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$page_name = 'DROM.RU (страница Arparts, наценка производиться не будет)';
			$link = 'baza.drom.ru Tuning';
			$action = action('ParserController@OurTuningDromParser');
			return view('admin.parts-parser', compact('page_name', 'link', 'action'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Создать деталь вручную
    public function CreatePartByHands(Request $request)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$link = $request['html'];
			foreach ($marks as $mark) {
					$alias = preg_replace("/ /","",$mark);
					// Найти в таблице название модели, если его нет, то создать
					$tableCar = Car::firstOrNew([
													'alias' => $alias
													], [
													'title' => $mark,
													'translate' => ''
													]);
					$tableCar->save();
					$mark = $tableCar->title.' ('.$tableCar->translate.')'; //сгененрировать название
					array_push($models, $alias);
				}
			$models = array_unique($models);
			$part = Part::create([
								'models' => $modelsToDB, 
								'category' => $category, 
								'titleOfAd' => $titleOfAd, 
								'price' => $price,
								'parsed_engine' => $enginesToDB,
								'number' => $number,
								'price_main' => $price_main,
								'image' => $image]);
			$part -> save();
		}
		else {
			return redirect('/login');
		}
    }
	
	//Парсер с Drom.ru
    public function DromParser(Request $request)
    {
        if (Auth::check() and Auth::user()->type == 'admin') {
            $link = $request['html'];
			$html = new \Htmldom($link);
            $title_promo=$html->find('h1.subject span', 0)->plaintext;
			$title_promo=trim($title_promo);
				$image=$html->find('link[rel="image_src"]', 0)->href;
				$image=substr($image,0,-10).'_bulletin.jpg';
				$types = array();
				foreach ($html->find('div[id=breadcrumbs] span') as $type) {
					$type=$type->plaintext;
					array_push($types, $type);
				}
				$title = array_pop($types);
				$category = $types[count($types)-1];
				$category = trim($category);
			    $price=$html->find('.viewbull-summary-price__value', 0)->plaintext;
				$price = substr($price,0,-4);
				$price = str_replace(" ","",$price);
				$price = (int) $price;
				$price_main = $price;
				if ($price<=5000) {
					$price = $price*1.45;
					$price = ceil($price/100) * 100;
				}
				else {
					$price = $price*1.3;
					$price = ceil($price/100) * 100;
				}
				$number=$html->find('span.inplace', 5)->plaintext;
				$number = explode(',', $number);  
				$number = $number[0];
				$number = trim($number);
				$models = array();
				foreach ($html->find('.autoPartsModel .inplace li') as $mark) {
					$mark = explode(',', $mark);
					$mark = str_replace("<li>","",$mark);
					$mark = str_replace("</li>","",$mark);
					$mark = $mark[0];
					$alias = preg_replace("/ /","",$mark);
					// Найти в таблице название модели, если его нет, то создать
					$tableCar = Car::firstOrNew([
													'alias' => $alias
													], [
													'title' => $mark,
													'translate' => ''
													]);
					$tableCar->save();
					$mark = $tableCar->title.' ('.$tableCar->translate.')'; //сгененрировать название
					array_push($models, $alias);
				}
				$models = array_unique($models);
				$engine=''; //пустое значение в массив
				$parsed_engine=$html->find('.autoPartsEngine span.inplace', 0)->plaintext; //парсим номера двигателей
				$engines = explode(', ', $parsed_engine); //разделяем их по зяпятой
				$withoutEndEngines = array(); //пустой массив для конечных вариантов
				foreach ($engines as $engine) {
					$engine = trim($engine); //убираем пробелы
					$amountOfLetters = iconv_strlen($engine); //считаем количество знаков в номере
					if ($amountOfLetters >= 5) {
						$engine = substr($engine,0,-2); //убираем последние 2
						$lastLetter = substr($engine, -1); //смотрим что осталось в конце
						if ($lastLetter == 'F' || $lastLetter == 'T') { //если это все-ещё модификация - дропаем её
							$engine = substr($engine,0,-1); //1 знак
						}
						array_push($withoutEndEngines, $engine); //добваляем в финальный массив
					}
					else {
						$lastLetter = substr($engine, -1); //смотрим что осталось в конце
						if ($lastLetter == 'F' || $lastLetter == 'T') { //если это все-ещё модификация - дропаем её
							$engine = substr($engine,0,-1);//1 знак
						}
						array_push($withoutEndEngines, $engine);//добваляем в финальный массив
					}
				}
				$withoutEndEngines = array_unique($withoutEndEngines); //только цникальные значения в массиве
				array_splice($withoutEndEngines, 5);
				$enginesToDB = implode(", ", $withoutEndEngines); //Двигатели, которые пойдут в БД
				$modelsToDB = implode(", ",$models); // Модели, которые пойдут в БД
				$firstMark = current($models); //первый элемент марки и модели
				$firstMarkFormDB = Car::where('alias', $firstMark)->first();//первая модель
				$firstMark = $firstMarkFormDB->title;//назначить первую модель в название
				$firstMark = trim($firstMark); //убрать лишние пробелы
				$firstMark = $firstMark.' '; //пробел в конце марки и модели
				$firstEngines = array_slice($withoutEndEngines,0,2); //получаем первые 2 двигателя
				$firstEngines = implode(", ", $firstEngines); //соединяем двигатели через запятую
				$titleOfAd = $title.$firstMark.'('.$firstEngines.')'; //создаем название
				$titleOfAd = trim($titleOfAd);
				$user_id = Auth::user()->id;
				$main_description =$titleOfAd.'';
				$additional_description_1 ='';
				$additional_description_2 ='';
				$additional_description_3 ='';
				//Добавляем в БД
				$part = Part::firstOrNew([	
										'link' => $link
										], [
										'user_id' => $user_id,
										'main_description' => $main_description,
										'additional_description_1' => $additional_description_1,
										'additional_description_2' => $additional_description_2,
										'additional_description_3' => $additional_description_3,
										'models' => $modelsToDB, 
										'category' => $category, 
                                        'titleOfAd' => $titleOfAd, 
                                        'price' => $price,
										'parsed_engine' => $enginesToDB,
                                        'number' => $number,
                                        'price_main' => $price_main,
                                        'image' => $image]);
				$part -> save();
				return view('parser.GetFromDrom', compact('link','title','image', 'price', 'number', 'models', 'engine', 'category', 'title_promo', 'price_main', 'parsed_engine', 'titleOfAd', 'description', 'main_description','part_description', 'additional_description_1', 'additional_description_2', 'additional_description_3'));
        }
        else {
            return redirect('/login');
        }
    }
	
	//Парсер с Drom.ru (из нашего магазина, без накрутки)
    public function OurDromParser(Request $request)
    {
        if (Auth::check() and Auth::user()->type == 'admin') {
            $link = $request['html'];
			$html = new \Htmldom($link);
            $title_promo=$html->find('h1.subject span', 0)->plaintext;
			$title_promo=trim($title_promo);
				$image=$html->find('link[rel="image_src"]', 0)->href;
				$image=substr($image,0,-10).'_bulletin.jpg';
				$types = array();
				foreach ($html->find('div[id=breadcrumbs] span') as $type) {
					$type=$type->plaintext;
					array_push($types, $type);
				}
				$title = array_pop($types);
				$category = $types[count($types)-1];
				$category = trim($category);
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
				$number=$html->find('span.inplace', 5)->plaintext;
				$number = explode(',', $number);  
				$number = $number[0];
				$number = trim($number);
				$models = array();
				foreach ($html->find('.autoPartsModel .inplace li') as $mark) {
					$mark = explode(',', $mark);
					$mark = str_replace("<li>","",$mark);
					$mark = str_replace("</li>","",$mark);
					$mark = $mark[0];
					$alias = preg_replace("/ /","",$mark);
					// Найти в таблице название модели, если его нет, то создать
					$tableCar = Car::firstOrNew([
													'alias' => $alias
													], [
													'title' => $mark,
													'translate' => ''
													]);
					$tableCar->save();
					$mark = $tableCar->title.' ('.$tableCar->translate.')'; //сгененрировать название
					array_push($models, $alias);
				}
				$models = array_unique($models);
				$engine=''; //пустое значение в массив
				$parsed_engine=$html->find('.autoPartsEngine span.inplace', 0)->plaintext; //парсим номера двигателей
				$engines = explode(', ', $parsed_engine); //разделяем их по зяпятой
				$withoutEndEngines = array(); //пустой массив для конечных вариантов
				foreach ($engines as $engine) {
					$engine = trim($engine); //убираем пробелы
					$amountOfLetters = iconv_strlen($engine); //считаем количество знаков в номере
					if ($amountOfLetters >= 5) {
						$engine = substr($engine,0,-2); //убираем последние 2
						$lastLetter = substr($engine, -1); //смотрим что осталось в конце
						if ($lastLetter == 'F' || $lastLetter == 'T') { //если это все-ещё модификация - дропаем её
							$engine = substr($engine,0,-1); //1 знак
						}
						array_push($withoutEndEngines, $engine); //добваляем в финальный массив
					}
					else {
						$lastLetter = substr($engine, -1); //смотрим что осталось в конце
						if ($lastLetter == 'F' || $lastLetter == 'T') { //если это все-ещё модификация - дропаем её
							$engine = substr($engine,0,-1);//1 знак
						}
						array_push($withoutEndEngines, $engine);//добваляем в финальный массив
					}
				}
				$withoutEndEngines = array_unique($withoutEndEngines); //только цникальные значения в массиве
				array_splice($withoutEndEngines, 5);
				$enginesToDB = implode(", ", $withoutEndEngines); //Двигатели, которые пойдут в БД
				$modelsToDB = implode(", ",$models); // Модели, которые пойдут в БД
				$firstMark = current($models); //первый элемент марки и модели
				$firstMarkFormDB = Car::where('alias', $firstMark)->first();//первая модель
				$firstMark = $firstMarkFormDB->title;//назначить первую модель в название
				$firstMark = trim($firstMark); //убрать лишние пробелы
				$firstMark = $firstMark.' '; //пробел в конце марки и модели
				$firstEngines = array_slice($withoutEndEngines,0,2); //получаем первые 2 двигателя
				$firstEngines = implode(", ", $firstEngines); //соединяем двигатели через запятую
				$titleOfAd = $title.$firstMark.'('.$firstEngines.')'; //создаем название
				$titleOfAd = trim($titleOfAd);
				$user_id = Auth::user()->id;
				$main_description =$titleOfAd.'';
				$additional_description_1 ='';
				$additional_description_2 ='';
				$additional_description_3 ='';
				//Добавляем в БД
				$part = Part::firstOrNew([	
										'link' => $link
										], [
										'user_id' => $user_id,
										'main_description' => $main_description,
										'additional_description_1' => $additional_description_1,
										'additional_description_2' => $additional_description_2,
										'additional_description_3' => $additional_description_3,
										'models' => $modelsToDB, 
										'category' => $category, 
                                        'titleOfAd' => $titleOfAd, 
                                        'price' => $price,
										'parsed_engine' => $enginesToDB,
                                        'number' => $number,
                                        'price_main' => $price_main,
                                        'image' => $image]);
				$part -> save();
				return view('parser.GetFromDrom', compact('link','title','image', 'price', 'number', 'models', 'engine', 'category', 'title_promo', 'price_main', 'parsed_engine', 'titleOfAd', 'description', 'main_description','part_description', 'additional_description_1', 'additional_description_2', 'additional_description_3'));
        }
        else {
            return redirect('/login');
        }
    }
	
	//Парсер с Drom.ru (из нашего магазина, без накрутки)
    public function OurTuningDromParser(Request $request)
    {
        if (Auth::check() and Auth::user()->type == 'admin') {
            $link = $request['html'];
			$html = new \Htmldom($link);
            $title_promo=$html->find('h1.subject span', 0)->plaintext;
			$title_promo=trim($title_promo);
			//Удаляем вхождения JDMstore \
			$title_promo = (string)$title_promo;
			$preTitle1 = 'JDMStore |';
			$preTitle2 = 'JDMStore|';
			$preTitle3 = 'в Санкт-Петербурге';
			if (strpos($title_promo, $preTitle1) !== false) {
				$title_promo = str_replace($preTitle1, '', $title_promo);
			}
			if (strpos($title_promo, $preTitle2) !== false) {
				$title_promo = str_replace($preTitle2, '', $title_promo);
			}
			if (strpos($title_promo, $preTitle3) !== false) {
				$title_promo = str_replace($preTitle3, '', $title_promo);
			}
			//Конец удаляем вхождения JDMstore \
				$image=$html->find('link[rel="image_src"]', 0)->href;
				$image=substr($image,0,-10).'_bulletin.jpg';
				$types = array();
				foreach ($html->find('div[id=breadcrumbs] span') as $type) {
					$type=$type->plaintext;
					array_push($types, $type);
				}
				//$title = array_pop($types);
				//$category = $types[count($types)-1];
				//$category = trim($category);
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
				/*$number=$html->find('span.inplace', 5)->plaintext;
				$number = explode(',', $number);  
				$number = $number[0];
				$number = trim($number);
				$models = array();
				foreach ($html->find('.autoPartsModel .inplace li') as $mark) {
					$mark = explode(',', $mark);
					$mark = str_replace("<li>","",$mark);
					$mark = str_replace("</li>","",$mark);
					$mark = $mark[0];
					$alias = preg_replace("/ /","",$mark);
					// Найти в таблице название модели, если его нет, то создать
					$tableCar = Car::firstOrNew([
													'alias' => $alias
													], [
													'title' => $mark,
													'translate' => ''
													]);
					$tableCar->save();
					$mark = $tableCar->title.' ('.$tableCar->translate.')'; //сгененрировать название
					array_push($models, $alias);
				}
				$models = array_unique($models);
				$engine=''; //пустое значение в массив
				$parsed_engine=$html->find('.autoPartsEngine span.inplace', 0)->plaintext; //парсим номера двигателей
				$engines = explode(', ', $parsed_engine); //разделяем их по зяпятой
				$withoutEndEngines = array(); //пустой массив для конечных вариантов
				foreach ($engines as $engine) {
					$engine = trim($engine); //убираем пробелы
					$amountOfLetters = iconv_strlen($engine); //считаем количество знаков в номере
					if ($amountOfLetters >= 5) {
						$engine = substr($engine,0,-2); //убираем последние 2
						$lastLetter = substr($engine, -1); //смотрим что осталось в конце
						if ($lastLetter == 'F' || $lastLetter == 'T') { //если это все-ещё модификация - дропаем её
							$engine = substr($engine,0,-1); //1 знак
						}
						array_push($withoutEndEngines, $engine); //добваляем в финальный массив
					}
					else {
						$lastLetter = substr($engine, -1); //смотрим что осталось в конце
						if ($lastLetter == 'F' || $lastLetter == 'T') { //если это все-ещё модификация - дропаем её
							$engine = substr($engine,0,-1);//1 знак
						}
						array_push($withoutEndEngines, $engine);//добваляем в финальный массив
					}
				}
				$withoutEndEngines = array_unique($withoutEndEngines); //только цникальные значения в массиве
				array_splice($withoutEndEngines, 5);
				$enginesToDB = implode(", ", $withoutEndEngines); //Двигатели, которые пойдут в БД
				$modelsToDB = implode(", ",$models); // Модели, которые пойдут в БД
				$firstMark = current($models); //первый элемент марки и модели
				$firstMarkFormDB = Car::where('alias', $firstMark)->first();//первая модель
				$firstMark = $firstMarkFormDB->title;//назначить первую модель в название
				$firstMark = trim($firstMark); //убрать лишние пробелы
				$firstMark = $firstMark.' '; //пробел в конце марки и модели
				$firstEngines = array_slice($withoutEndEngines,0,2); //получаем первые 2 двигателя
				$firstEngines = implode(", ", $firstEngines); //соединяем двигатели через запятую*/
				$titleOfAd = $title_promo; //создаем название
				$titleOfAd = trim($titleOfAd);
				$user_id = Auth::user()->id;
				$main_description =$html->find('p.inplace', 0)->plaintext;
				$additional_description_1 ='';
				$additional_description_2 ='';
				$additional_description_3 ='';
				//Добавляем в БД
				$part = Part::firstOrNew([	
										'link' => $link
										], [
										'user_id' => $user_id,
										'main_description' => $main_description,
										'additional_description_1' => $additional_description_1,
										'additional_description_2' => $additional_description_2,
										'additional_description_3' => $additional_description_3,
										'models' => '', 
										'category' => 'Тюнинг', 
                                        'titleOfAd' => $titleOfAd, 
                                        'price' => $price,
										'parsed_engine' => '',
                                        'number' => '',
                                        'price_main' => $price_main,
                                        'image' => $image]);
				$part -> save();
				return redirect()->back();
        }
        else {
            return redirect('/login');
        }
    }
	
	//База объявлений
    public function PartsTable()
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$xmlRoute = route('xml');
			$parts = Part::orderBy('created_at', 'desc')->paginate(40);
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
			return view('admin.parts-table', compact('parts', 'translations', 'xmlRoute'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Страница из
    public function PartPage($id, Request $request)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$part = Part::find($id);
			$action = action('ParserController@PartEdit', $id);
			return view('parser.PartPage', compact('part', 'action'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Удалить окончание описания *Подходит для большинства автомобилей! бла-бла-бла...*
    public function ClearEnd()
    {
		//Можно только залогиненым адменам
		if (Auth::check() and Auth::user()->type == 'admin') {
			//Находим все товары с категорией Тюнинг
			$parts = Part::where('avito_category','22')->get();
			
			//Для каждого товара применяем правило
			foreach ($parts as $part) {
				//Если есть слово *автомобилей*
				if (strpos($part->main_description, 'автомобилей') !== false) {
					//Получаем значение описания
					$description = $part->main_description;
					//Удаляем все полсле слова *автомобилей*
					$part->main_description = preg_replace("!(?<=автомобилей).+!is", "", $description);
					//$Сохраняем
					$part->save();
				}
			}
			//Выполнено
			echo 'Готово';
		}
		else {
			//Гоу хоум
			return redirect('/login');
		}
    }
	
	//Страница из БД
    public function IndexPartPage($id, Part $part)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$part = Part::find($id); //находим элемент в БД
			// получаем данные по элементу
			$link = $part->link;
			$title = $part->titleOfAd;
			$category = $part->category;
			$price = $part->price;
			$parsed_engine = $part->parsed_engine;
			$number = $part->number;
			$price_main = $part->price_main;
			$image = $part->image;
			$models = $part->models;
			$description = $part->description;
			// получили данные
				$models = explode(',', $models); //создаем массив из моеделей авто
				$translations = array(); //пустой массив
				foreach ($models as $model) {
					$model = trim($model); //удаляем пробелы
					$car = Car::where('alias', $model)->first(); //находим тачку в таблице Автомобилей
					$translation = $car->title.' ('.$car->translate.')'; //получаем данные
					array_push ($translations, $translation); //добавляем данные в таблицу
				}
				$originalModels = array(); //пустой массив
				foreach ($models as $model) {
					$model = trim($model); //удаляем пробелы
					$car = Car::where('alias', $model)->first(); //находим тачку в таблице Автомобилей
					$originalModel = $car->title; //получаем данные
					array_push ($originalModels, $originalModel); //добавляем данные в таблицу
				}
			$twoModels = array_slice($originalModels,0,1);
			$twoModels = implode(" ", $twoModels);
				$engines = explode(',', $parsed_engine);
				$twoEngines = array(); //пустой массив
				$twoEngines = array_slice($engines,0,2);
				$twoEngines = implode(",", $twoEngines);
			//$title_promo = $title.' '.$twoModels.' ('.$twoEngines.')'; //автоматическая генерация названия
			$title_promo = $part->titleOfAd; //ручная генерация названия
			$titleOfAd = $title;
			$keywords = Keyword::get();
			$part_description = $part->part_description;
			//$link = Storage::disk('local')->url('42.jpg');
			return view('admin.part-page', compact('link','title','image', 'price', 'number', 'models', 'engine', 'category', 'title_promo', 'price_main', 'parsed_engine', 'titleOfAd', 'part', 'translations', 'description', 'keywords', 'part_description'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Изменить информацию о запчасти
    public function PartEdit(Keyword $keyword,Part $part, $id, Request $request)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$user = Auth::user();
			if ($user -> type == 'admin') {
				$part = Part::find($id);
				$newTitle = $request['newTitle'];
				$newImage = $request['newImage'];
				$newFile = $request['newFile'];
				//Начало Редактирование списка автомобилей
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
				$part->models = implode(",", $alias_models);
				$part->save();
				//Конец Редактирвоания списка автомобилей
				$newCategory = $request['newCategory'];
				$newPrice = $request['newPrice'];
				$newPrice_main = $request['newPrice_main'];
				$newLink = $request['newLink'];
				$newParsed_engine = $request['newParsed_engine'];
				$newNumber = $request['newNumber'];
				$newAvito_category = $request['newAvito_category'];
				$newDescription = $request['newDescription'];
				$main_description = $request['main_description'];
				$newPart_description = $request['newPart_description'];
				//$keyword = Keyword::find('words','==', $newPart_description)->words; //поиск ключевых слов по id в БД

				if ($newTitle != NULL) {
					$part->titleOfAd=$newTitle;
						$part->save();
				}
				if ($newImage != NULL) {
					$part->image=$newImage;
						$part->save();
				}
				/*if ($newModels != NULL) {
					$part->models=$models;
						$part->save();
				}*/
				if ($newCategory != NULL) {
					$part->category=$newCategory;
						$part->save();
				}
				if ($newPrice != NULL) {
					$part->price=$newPrice;
						$part->save();
				}
				if ($newLink != NULL) {
					$part->link=$newLink;
						$part->save();
				}
				if ($newPrice_main != NULL) {
					$part->price_main=$newPrice_main;
						$part->save();
				}
				if ($newParsed_engine != NULL) {
					$part->parsed_engine=$newParsed_engine;
						$part->save();
				}
				if ($newNumber != NULL) {
					$part->number=$newNumber;
						$part->save();
				}
				if ($newAvito_category != NULL) {
					$part->avito_category=$newAvito_category;
						$part->save();
				}
				if ($newDescription != NULL) {
					$part->description=$newDescription;
						$part->save();
				}
				if ($main_description != NULL) {
					$part->main_description=$main_description;
						$part->save();
				}
				$part->part_description=$newPart_description;
					$part->save();
				if ($newFile != NULL) {
					$image_name = 'p_'.$part->id.'.jpg';
					if ($exists = Storage::disk('local')->exists('public/'.$image_name)) {
						Storage::disk('local')->delete('public/'.$image_name);
					}
					Storage::disk('local')->put('public/'.$image_name, File::get($newFile));
					$link = env('APP_URL').Storage::disk('local')->url('public/'.$image_name);
					$part->image=$link;
						$part->save();
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
	
	//Изменить транскрипцию названия автомобиля
    /*public function UpdateTranslation(Part $part, $id, Request $request)
    {
		if (Auth::check()) {
			$user = Auth::user();
			if ($user -> type == 'admin') {
				$part = Part::find($id);
				$models = $part->models;
				// получили данные
				$models = explode(',', $models); //создаем массив из моеделей авто
				$translations = array(); //пустой массив
				foreach ($models as $model) {
					$model = trim($model); //удаляем пробелы
					$car = Car::where('alias', $model)->first(); //находим тачку в таблице Автомобилей
					$translation = $car->title.' ('.$car->translate.')'; //получаем данные
					array_push ($translations, $translation); //добавляем данные в таблицу
				}
				$translations=implode(", ",$translations);
				$part->translation=$translations;
				$part->save();
				return redirect()->back();
			}
			else {
				return redirect()->back();
			}
			
		}
		else {
			return redirect('/login');
		}
    }*/
	
	//Изменить транскрипцию названия автомобиля
    public function PartDelete(Part $part, $id, Request $request)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$user = Auth::user();
			if ($user -> type == 'admin') {
				$part = Part::find($id);
				$part->delete();
				return redirect()->route('parts.table');
			}
			else {
				return redirect()->back();
			}
			
		}
		else {
			return redirect('/login');
		}
    }
	
	//Получить XML файл
    public function PartXML(Part $part, Car $car)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$parts = Part::all();
			/*foreach ($parts as $part) {
				$models = $part->models;
				$models = explode(',', $models);
				$translations = array();
				foreach ($models as $model) {
					$model = trim($model);
					$car = Car::where('alias', $model)->first();
					$translation = $car->title.' ('.$car->translate.'),';
					array_push ($translations, $translation);
				}
				array_splice($translations, 5);
				//print_r($translations);
			}
			$collection = collect($translations);*/
			return view('parser.PartsXML', compact('parts', 'models', 'translations','collection'));
		}
		else {
			return redirect('/login');
		}
    }
	
	
	//   CARS
	
	//База автомобилей
    public function CarsTable()
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$cars = Car::orderBy('title', 'desc')->get();
			return view('admin.cars-table', compact('cars'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Страница автомобиля
    public function CarPage($id, Request $request)
    {
		if (Auth::check()) {
			$car = Car::find($id);
			$action = action('ParserController@CarTranslate', $id);
			return view('admin.car-page', compact('car', 'action'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Изменить транскрипцию названия автомобиля
    public function CarTranslate(Car $car, $id, Request $request)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$car = Car::find($id);
			$translate = $request['translate'];
			$car->translate=$translate;
				$car->save();
			return redirect()->back();
		}
		else {
			return redirect('/login');
		}
    }
	
	//Получить XML файл с запчастями
    public function PartToShop($id, $shopId)
    {
		if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			$part = Part::find($id);
			$product = Product::create([
					'name' => $part->titleOfAd, 
					'price' => $part->price,
					'description' => $part->main_description,
					'meta' => $part->parsed_engine,
					'models'=> $part->models,
					'image' => $part->image,
					'shop_id' => $shop->id]);
			$product->save();
			return redirect()->route('products.table',['id' => $shop->id]);
		}
		else {
			return redirect('/login');
		}
    }
}

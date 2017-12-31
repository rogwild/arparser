<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Part;
use App\Car;

class ParserController extends Controller
{
    //Выбор парсера
    public function index(Request $request)
    {
		if (Auth::check()) {
			return view('parser.chooseParser');
		}
		else {
			return redirect('/login');
		}
    }
	
	//Выбор парсера
    public function LinkToDrom()
    {
		if (Auth::check()) {
			$page_name = 'DROM.RU';
			$link = 'baza.drom.ru';
			$action = action('ParserController@DromParser');
			return view('parser.InputLink', compact('page_name', 'link', 'action'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Парсер с Drom.ru
    public function DromParser(Request $request)
    {
        if (Auth::check()) {
            $link = $request['html'];
			$html = new \Htmldom($link);
            $title_promo=$html->find('h1.subject span', 0)->plaintext;
				$image=$html->find('link[rel="image_src"]', 0)->href;
				$image=substr($image,0,-10).'_bulletin.jpg';
				$types = array();
				foreach ($html->find('div[id=breadcrumbs] span') as $type) {
					$type=$type->plaintext;
					array_push($types, $type);
				}
				$title = array_pop($types);
				$category = $types[count($types)-1];
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
					array_push($models, $mark);
				}
				$models = array_unique($models);
				$engine=''; //пустое значение в массив
				$parsed_engine=$html->find('.autoPartsEngine span.inplace', 0)->plaintext; //парсим номера двигателей
				$engines = explode(',', $parsed_engine); //разделяем их по зяпятой
				$withoutEndEngines = array(); //пустой массив для конечных вариантов
				foreach ($engines as $engine) {
					$engine = trim($engine); //убираем пробелы
					$amountOfLetters = iconv_strlen ($engine); //считаем количество знаков в номере
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
				$firstMark = current($models); //первый элемент марки и модели
				$firstMark = $firstMark.' '; //пробел в конце марки и модели
				$firstEngines = array_slice($withoutEndEngines,0,2); //получаем первые 2 двигателя
				$firstEngines = implode(", ", $firstEngines); //соединяем двигатели через запятую
				$titleOfAd = $title.$firstMark.'('.$firstEngines.')'; //создаем название
				
				//Добавляем в БД
				$part = Part::create([	'models' => '$models', 
										'category' => $category, 
                                        'titleOfAd' => $titleOfAd, 
                                        'price' => $price,
										'parsed_engine' => '$parsed_engine',
                                        'number' => '$number', 
                                        'link' => $link, 
                                        'price_main' => $price_main,
                                        'image' => $image]);
			
				return view('parser.GetFromDrom', compact('link','title','image', 'price', 'number', 'models', 'engine', 'category', 'title_promo', 'price_main', 'parsed_engine', 'titleOfAd'));
        }
        else {
            return redirect('/login');
        }
    }
	
	//База автомобилей
    public function CarsTable()
    {
		if (Auth::check()) {
			$cars = Car::orderBy('title', 'desc')->get();
			return view('parser.CarsTable', compact('cars'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Страница из
    public function CarPage($id, Request $request)
    {
		if (Auth::check()) {
			$car = Car::find($id);
			$action = action('ParserController@CarTranslate', $id);
			return view('parser.CarPage', compact('car', 'action'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Изменить транскрипцию названия автомобиля
    public function CarTranslate(Car $car, $id, Request $request)
    {
		if (Auth::check()) {
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
}

<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Part;
use App\Car;
use App\User;

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
	
	//Создать деталь вручную
    public function CreatePartByHands(Request $request)
    {
		if (Auth::check()) {
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
        if (Auth::check()) {
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
				//Добавляем в БД
				$part = Part::firstOrNew([	
										'link' => $link
										], [ 
										'models' => $modelsToDB, 
										'category' => $category, 
                                        'titleOfAd' => $titleOfAd, 
                                        'price' => $price,
										'parsed_engine' => $enginesToDB,
                                        'number' => $number,
                                        'price_main' => $price_main,
                                        'image' => $image]);
				$part -> save();
				return view('parser.GetFromDrom', compact('link','title','image', 'price', 'number', 'models', 'engine', 'category', 'title_promo', 'price_main', 'parsed_engine', 'titleOfAd'));
        }
        else {
            return redirect('/login');
        }
    }
	
	//База объявлений
    public function PartsTable()
    {
		if (Auth::check()) {
			$parts = Part::orderBy('created_at', 'desc')->get();
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
			return view('parser.PartsTable', compact('parts', 'translations'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Страница из
    public function PartPage($id, Request $request)
    {
		if (Auth::check()) {
			$part = Part::find($id);
			$action = action('ParserController@PartEdit', $id);
			return view('parser.PartPage', compact('part', 'action'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Страница из БД
    public function IndexPartPage($id, Part $part)
    {
		if (Auth::check()) {
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
			return view('parser.IndexPartPage', compact('link','title','image', 'price', 'number', 'models', 'engine', 'category', 'title_promo', 'price_main', 'parsed_engine', 'titleOfAd', 'part', 'translations', 'description'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Изменить транскрипцию названия автомобиля
    public function PartEdit(Part $part, $id, Request $request)
    {
		if (Auth::check()) {
			$user = Auth::user();
			if ($user -> type == 'admin') {
				$part = Part::find($id);
				$newTitle = $request['newTitle'];
				$newImage = $request['newImage'];
				//$newModels = $request['newModels'];
				$newCategory = $request['newCategory'];
				$newPrice = $request['newPrice'];
				$newPrice_main = $request['newPrice_main'];
				$newLink = $request['newLink'];
				$newParsed_engine = $request['newParsed_engine'];
				$newNumber = $request['newNumber'];
				$newAvito_category = $request['newAvito_category'];
				$newDescription = $request['newDescription'];
				if ($newTitle != NULL) {
					$part->titleOfAd=$newTitle;
						$part->save();
				}
				if ($newImage != NULL) {
					$part->image=$newImage;
						$part->save();
				}
				/*if ($newModels != NULL) {
					$part->models=$newModels;
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
		if (Auth::check()) {
			$user = Auth::user();
			if ($user -> type == 'admin') {
				$part = Part::find($id);
				$part->delete();
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
	
	//Получить XML файл
    public function PartXML(Part $part, Car $car)
    {
		if (Auth::check()) {
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
		if (Auth::check()) {
			$cars = Car::orderBy('title', 'desc')->get();
			return view('parser.CarsTable', compact('cars'));
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

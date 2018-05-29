<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	protected $fillable = [
        'name','image', 'user_id', 'category_id', 'visibility', 'information', 'additional_information'
    ];
	
    public function by(User $user) {
            $this->user_id = $user->id;
        }
	
	public function user() {
		return $this->belongsTo('App\User');
	  }
	
	public function PartLink() {
		return $this->hasMany('App\PartLink');
	  }
	
	public function addProduct($link, $description, $models, $category_id, $name, $price, $meta, $image) {
		Product::create([	
						'link' => $link,
						'shop_id' => $this->id,
						'description' => $description,
						'models' => $models,
						'category_id' => $category_id, 
						'name' => $name, 
						'price' => $price,
						'meta' => $meta,
						'image' => $image]);
	}
	
	public function parserStandart($link, $shop, $partlink) {
		// Добавляем в парсер
		$html = new \Htmldom($link);
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
			$title = $category_from_drom;
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
		$models = array();
		$engines = array();
		$numbers = '';
		$text = '';
		// Подсчет и отображение всех информационных полей
		foreach ($html->find('.fieldset div.field .label') as $i) {
			$name = $i->plaintext;
			print($name).':';
			if ($name == 'Номера в каталоге производителя') {
				$parsed_numbers = $html->find('span[data-field=autoPartsNumber]', 0)->plaintext;
				$numbers = explode(', ', $parsed_numbers); //разделяем их по зяпятой
				$numbers = array_splice($numbers, 5); // Берем только 5 штук
				$numbers = implode(", ", $numbers); //Номера, которые пойдут в БД
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
		// Описание товара
		if(($html->find('.bulletinText', 0))) {
			$text = $html->find('.bulletinText', 0)->plaintext;
		}
		if ($models != NULL) {
			$firstMark = array_shift($models); //первый элемент марки и модели
			$firstMarkFormDB = Car::where('alias', $firstMark)->first();//первая модель
			$firstMark = $firstMarkFormDB->title;//назначить первую модель в название
			$firstMark = trim($firstMark); //убрать лишние пробелы
			$firstMark = $firstMark.' '; //пробел в конце марки и модели
		}
		else {
			$firstMark = ' '; //пробел в конце марки и модели
		}
		if ($engines != NULL) {
			$firstEngines = array_slice($engines,0,2); //получаем первые 2 двигателя
			$firstEngines = implode(", ", $firstEngines); //соединяем двигатели через запятую
			$firstEngines = '('.$firstEngines.')';
		}
		else {
			$firstEngines = ' ';
		}
		
		$titleOfAd = $title.$firstMark.$firstEngines; //создаем название
		$titleOfAd = trim($titleOfAd);
		$title_promo = $titleOfAd;
		// Мета теги - двигатели
		$meta = $enginesToDB;
		// Описание - текст с описания на дроме
		$description = trim($text);
		if ($numbers != NULL) {
			$description = $description.'  '.'Номер в каталоге производителя: '.$numbers;
		}
		// Отображение
		print($description);
		// Добавляем в БД
		$link = $partlink->link;
		$same = Product::where('shop_id', $shop->id)->where('link', $link)->count();
			if ($same == 0 and $image != NULL) {

				$shop->addProduct($link, $description, $modelsToDB, $category, $title_promo, $price_main, $meta, $image);

			}
	}
}

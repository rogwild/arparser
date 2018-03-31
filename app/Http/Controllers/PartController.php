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

class PartController extends Controller
{
    //Страница магазина arparts/
    public function MainPage()
    {
		$title = 'Главная';
		$slide1_name = 'Магазин автозапчастей нового поколения'; //Текст на слайдере
		$slide1_bullit = 'У нас есть все'; //Текст на слайдере
		$slide1_text = 'Мы не первые, но у нас есть мечта'; //Текст на слайдере
		$new_parts = Part::orderBy('created_at', 'desc')->take(20)->get(); //6 товаров в верный блок "Новое поступление"
		$popular_parts = Part::orderBy('created_at', 'name')->take(10)->get(); //6 товаров в верный блок "Новое поступление"
		return view('shop.main-page', compact('title', 'slide1_name', 'slide1_bullit', 'slide1_text', 'new_parts', 'popular_parts'));
	}
	
	//Страница магазина со всеми товарами arparts/all-parts
    public function AllPartsPage()
    {
		$title = 'Главная';
		$slide1_name = 'Магазин автозапчастей нового поколения'; //Текст на слайдере
		$slide1_bullit = 'У нас есть все'; //Текст на слайдере
		$slide1_text = 'Мы не первые, но у нас есть мечта'; //Текст на слайдере
		$parts = Part::orderBy('created_at', 'desc')->paginate(12); //6 товаров в верный блок "Новое поступление"
		$popular_parts = Part::orderBy('created_at', 'name')->take(4)->get(); //6 товаров в верный блок "Новое поступление"
		return view('shop.all-parts-page', compact('title', 'slide1_name', 'slide1_bullit', 'slide1_text', 'parts', 'popular_parts'));
	}
	
	//Страница магазина со всеми товарами arparts/all-parts
    public function PartPage($partId)
    {
		$part = Part::findOrFail($partId); //поиск товара в БД по id
		$popular_parts = Part::orderBy('created_at', 'name')->take(4)->get(); //6 товаров в верный блок "Новое поступление"
		$new_parts = Part::orderBy('created_at', 'desc')->take(6)->get(); //6 товаров в верный блок "Новое поступление"
		return view('shop.part-page', compact('part','popular_parts','new_parts'));
	}
}

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

class CategoryController extends Controller
{
    //Таблица ключевых слов
    public function CategoryPage($id, Request $request)
    {
		if (Auth::check()) {
			$thiscategory = Category::find($id);
			if ($thiscategory->parent_id == 0) {
				$nameOfParentCategory = 'Нет родительской категории';
			}
			else {
				$parentid = $thiscategory->parent_id;
				$parentcategory = Category::find($parentid);
				$nameOfParentCategory = $parentcategory->name;
			}
			$categories = Category::where('parent_id', 0)->get();
			return view('admin.category-page', compact('thiscategory', 'categories', 'nameOfParentCategory'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Старинца создания категории
    public function CategoryPageCreate()
    {
		if (Auth::check()) {
			$categories = Category::where('parent_id', 0)->get();
			return view('admin.category-create-page', compact('categories'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Создать категорию (роут)
    public function CategoryCreate(Request $request)
    {
		if (Auth::check()) {
			$name=$request['name'];
			$slug=$request['slug'];
			$parent_id=$request['parent'];
			$avito = $request['avito'];
			$category = Category::create([
					'name' => $name, 
					'slug' => $slug,
					'parent_id' => $parent_id]);
			$category -> save();
			return redirect()->route('categories.table');
		}
		else {
			return redirect('/login');
		}
    }
	
	//Изменить информацию о категории
    public function CategoryEdit($id, Request $request)
    {
		if (Auth::check()) {
			$user = Auth::user();
			if ($user -> type == 'admin') {
				$category = Category::find($id);
					$category->name = $request['name'];
					$category->slug = $request['slug'];
					$category->parent_id = $request['parent'];
					$category->avito = $request['avito'];
					$category->save();
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
	
	//Таблица категорий
    public function CategoriesTable(Request $request)
    {
		if (Auth::check()) {
			$pagename = "Страница категорий";
			$categories = Category::orderBy('name', 'desc')->get();
			return view('admin.categories-table', compact('categories', 'pagename'));
		}
		else {
			return redirect('/login');
		}
    }
}

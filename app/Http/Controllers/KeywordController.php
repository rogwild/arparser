<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Part;
use App\Car;
use App\User;
use App\Keyword;
use App\Category;

class KeywordController extends Controller
{
	//Таблица ключевых слов
    public function KeywordPage($id, Request $request)
    {
		if (Auth::check()) {
			$keyword = Keyword::find($id);
			return view('admin.keyword-page', compact('keyword'));
		}
		else {
			return redirect('/login');
		}
    }
	
	//Таблица ключевых слов
    public function KeywordPageCreate()
    {
		if (Auth::check()) {
			return view('admin.keyword-create');
		}
		else {
			return redirect('/login');
		}
    }
	
	//Создать ключевое слово (роут)
    public function KeywordCreate(Request $request)
    {
		if (Auth::check()) {
			$name=$request['name'];
			$words=$request['words'];
			$keyword = Keyword::create([
					'name' => $name, 
					'words' => $words]);
			$keyword -> save();
			return redirect()->route('keywords.table');
		}
		else {
			return redirect('/login');
		}
    }
	
	//Изменить информацию о запчасти
    public function KeywordEdit(Keyword $keyword, $id, Request $request)
    {
		if (Auth::check()) {
			$user = Auth::user();
			if ($user -> type == 'admin') {
				$keyword = Keyword::find($id);
				$newName = $request['newName'];
				$newWords = $request['newWords'];

				if ($newName != NULL) {
					$keyword->name=$newName;
						$keyword->save();
				}
				$keyword->words=$newWords;
					$keyword->save();
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
	
    //Таблица ключевых слов
    public function KeywordsTable(Request $request)
    {
		if (Auth::check()) {
			$keywords = Keyword::orderBy('name', 'desc')->get();
			return view('admin.keywords-table', compact('keywords'));
		}
		else {
			return redirect('/login');
		}
    }
}

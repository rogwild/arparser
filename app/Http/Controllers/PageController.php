<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Part;
use App\Car;
use App\User;

class PageController extends Controller
{
    //Главная страница Arparts
    public function index(Request $request)
    {
		if (Auth::check()) {
			return view('arparts.main');
		}
		else {
			return redirect('/login');
		}
    }
}

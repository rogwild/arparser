<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Part;
use App\Car;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$administrator_name = Auth::user()->name;
		$amount_of_parts = Part::count();
		$amount_of_cars = Car::count();
		$amount_of_users = User::count();
		$xmlRoute = route('xml');
		$parts = Part::orderBy('created_at', 'desc')->take(15)->get();
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
		}
		$cars = Car::orderBy('created_at', 'desc')->take(15)->get();
        return view('admin.home', compact('administrator_name', 'amount_of_cars','amount_of_parts','amount_of_users', 'parts', 'translations', 'xmlRoute', 'cars'));
    }
}

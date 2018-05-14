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
use App\ExtraWords;
use App\PartLink;
use Storage;
use File;
use DateTime;

class ExtraWordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shopId)
    {
        if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			$words = ExtraWords::where('shop_id',$shopId)->get();
			return view('extrawords.table', compact('shop', 'words'));
		}
		else {
			return redirect('/login');
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($shopId)
    {
        if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			return view('extrawords.create', compact('shop'));
		}
		else {
			return redirect('/login');
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $shopId)
    {
        if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			$words = ExtraWords::create([
					'title' => $request['title'], 
					'body' => $request['body'],
					'shop_id' => $shop->id]);
			$shop -> save();
			return redirect()->route('extrawords.table', [$shop->id]);
		}
		else {
			return redirect('/login');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($shopId, $wordId)
    {
        if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			$word = ExtraWords::find($wordId);
			return view('extrawords.show', compact('shop', 'word'));
		}
		else {
			return redirect('/login');
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $shopId, $wordId)
    {
        if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			$word = ExtraWords::find($wordId);
			$word->title = $request['title'];
			$word->body = $request['body'];
			$word -> save();
			return redirect()->route('extrawords.table', [$shop->id]);
		}
		else {
			return redirect('/login');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($shopId, $wordId)
    {
        if (Auth::check() and Auth::user()->type == 'admin') {
			$shop = Shop::find($shopId);
			$word = ExtraWords::find($wordId);
			$word -> delete();
			return redirect()->route('extrawords.table', [$shop->id]);
		}
		else {
			return redirect('/login');
		}
    }
}

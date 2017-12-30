<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
	protected $fillable = [
        'link','title','image', 'price', 'number', 'models', 'engine', 'category', 'title_promo', 'price_main', 'parsed_engine', 'titleOfAd'
    ];
}

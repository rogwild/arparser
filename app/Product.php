<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
	protected $fillable = [
        'name','image', 'shop_id', 'category_id', 'visibility', 'price', 'description', 'models', 'meta'
    ];
	
	public function shop()
	  {
		return $this->belongsTo('App\Shop');
	  }
}

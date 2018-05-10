<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartLink extends Model
{
    protected $fillable = [
        'shop_id', 'link', 'title'
    ];
	
	public function shop()
	{
		return $this->belongsTo('App\Shop');
	}
}

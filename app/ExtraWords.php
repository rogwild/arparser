<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraWords extends Model
{
    protected $fillable = [
        'shop_id', 'title', 'body'
    ];
	
	public function Shop()
  	{
		return $this->belongsTo('App\Shop');
  	}
}

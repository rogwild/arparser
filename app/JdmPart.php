<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JdmPart extends Model
{
    protected $fillable = [
        'link','title','image', 'price', 'number', 'models', 'engine', 'category', 'title_promo', 'price_main', 'parsed_engine', 'titleOfAd', 'avito_category', 'description', 'main_description','part_description', 'additional_description_1', 'additional_description_2', 'additional_description_3', 'user_id'
    ];
	
	public function user()
	  {
		return $this->belongsTo('App\User');
	  }
}

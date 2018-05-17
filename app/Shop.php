<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	protected $fillable = [
        'name','image', 'user_id', 'category_id', 'visibility', 'information', 'additional_information'
    ];
	
    public function by(User $user) {
            $this->user_id = $user->id;
        }
	
	public function user() {
		return $this->belongsTo('App\User');
	  }
	
	public function PartLink() {
		return $this->hasMany('App\PartLink');
	  }
	
	public function addProduct($link, $description, $models, $category_id, $name, $price, $meta, $image) {
		Product::create([	
						'link' => $link,
						'shop_id' => $this->id,
						'description' => $description,
						'models' => $models,
						'category_id' => $category_id, 
						'name' => $name, 
						'price' => $price,
						'meta' => $meta,
						'image' => $image]);
	}
}

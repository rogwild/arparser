<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	protected $fillable = [
        'name','image', 'user_id', 'category_id', 'visibility'
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
}

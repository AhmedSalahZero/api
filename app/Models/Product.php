<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'name','price','category_id','slug','user_id'
	];
	
	public function user()
	{
		return $this->belongsTo(User::class , 'user_id','id');
	}
	public function category()
	{
		return $this->belongsTo(Category::class , 'category_id','id');
	}
	
	
}

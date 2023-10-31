<?php

namespace App\Observers;

use App\Models\Product; 
use Illuminate\Support\Str;
class ProductObserver
{
	public function updated(Product $product)
	{
		$product->slug = Str::slug($product->name);
		
	}
}

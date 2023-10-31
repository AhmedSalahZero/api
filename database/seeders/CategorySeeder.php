<?php

namespace Database\Seeders;

use App\Models\Category ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach(['cate1','cate2'] as $categoryName){
			Category::factory()->create([
				'name'=>$categoryName ,
				'slug'=>Str::slug($categoryName)
			]);
		}
    }
}

<?php

namespace App\Providers;

use App\Models\CategoryService;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Observers\ProductObserver;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Product::observe(ProductObserver::class);
		$this->handleRaterLimiter();
    }
	
	public function handleRaterLimiter()
	{
		RateLimiter::for('view',function($request){
			return Limit::perMinute(50);
		});
		
	}
}

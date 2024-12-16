<?php

namespace App\Providers;

use App\Charts\SampleChart;
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
//    public function boot(Charts $charts)
//    {
//        $charts->register([
//            SampleChart::class
//        ]);
//    }
}

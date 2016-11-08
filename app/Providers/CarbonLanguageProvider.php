<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class CarbonLanguageProvider extends ServiceProvider {

    public function boot()
    {
        //
    }

    public function register()
    {
        Carbon::setLocale($this->app->getLocale());
    }

}
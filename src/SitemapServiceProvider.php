<?php

namespace FinalStrike\Sitemap;

use Illuminate\Support\ServiceProvider;

class SitemapServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('sitemap', function(){
            return new Sitemap();
        });
    }
    public function boot()
    {
        $this->registerViews();
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'fs');
        if($this->app->runningInConsole()){
            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/sitemap')
            ]);
        }
    }
}

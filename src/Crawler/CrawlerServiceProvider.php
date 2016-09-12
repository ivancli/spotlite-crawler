<?php
namespace Invigor\Crawler;
use Illuminate\Support\ServiceProvider;


/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 9/12/2016
 * Time: 10:19 AM
 */
class CrawlerServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSLCrawler();


    }

    private function registerSLCrawler()
    {
        $this->app->bind('slcrawler', function ($app) {
            return new SLCrawler($app);
        });
        $this->app->alias('slcrawler', 'Invigor\SLCrawler\SLCrawler');
    }
}
<?php
namespace Invigor\Crawler;
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 9/12/2016
 * Time: 10:13 AM
 */
class Crawler
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new confide instance.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 9/12/2016
 * Time: 12:16 PM
 */

namespace Invigor\SLCrawler;


use Illuminate\Support\Facades\Facade;

class SLCrawlerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'slcrawler';
    }
}
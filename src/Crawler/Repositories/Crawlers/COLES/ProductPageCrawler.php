<?php
namespace Invigor\Crawler\Repositories\Crawlers\COLES;

use Invigor\Crawler\Contracts\CrawlerInterface;
use Invigor\Crawler\Traits\Curler;

/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 10/12/2016
 * Time: 1:40 PM
 */
class ProductPageCrawler implements CrawlerInterface
{
    use Curler;

    protected $options;
    protected $html;

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * Get HTML code from variable
     *
     * @return mixed
     */
    public function getHTML()
    {
        return $this->html;
    }

    /**
     * Load HTML code from web
     *
     * @param $options
     * @return mixed
     */
    public function loadHTML()
    {
        $this->setCurlURL($this->getURL());
        $result = $this->sendCurl();
        $storeId = trim($this->get_string_between($result, "'storeId':", ','));

        $productName = basename(parse_url($this->getURL())['path']);

        $priceURL = "https://shop.coles.com.au/search/resources/store/$storeId/productview/bySeoUrlKeyword/$productName";

        $this->setCurlURL($priceURL);
        $resultJSON = $this->sendCurl();
        $this->html = $resultJSON;
    }

    /**
     * Get HTML code from cache
     *
     * @param $key
     * @return mixed
     */
    public function getCachedHTML($key)
    {
        // TODO: Implement getCachedHTML() method.
    }

    /**
     * Set HTML code to cache
     *
     * @param $options
     * @return mixed
     */
    public function setCachedHTML($options)
    {
        // TODO: Implement setCachedHTML() method.
    }

    /**
     * Remove HTML code from cache
     *
     * @param $key
     * @return mixed
     */
    public function removeCachedHTML($key)
    {
        // TODO: Implement removeCachedHTML() method.
    }

    private function getURL()
    {
        if (isset($this->options['url'])) {
            return $this->options['url'];
        }
        return null;
    }

    private function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }


}
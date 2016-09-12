<?php
namespace Invigor\Crawler\Repositories;
use Invigor\Crawler\Contracts\CrawlerInterface;
use Invigor\Crawler\Traits\Curler;

/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 9/12/2016
 * Time: 10:31 AM
 */
class DefaultCrawler implements CrawlerInterface
{
    use Curler;

    protected $html = "";
    protected $options = array();

    public function __construct()
    {
    }

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
     * @return mixed
     */
    public function loadHTML()
    {
        $cookie = $this->getCookie();
        if ($cookie != false && isset($cookie['header'])) {
            $this->pushCurlHeaders($cookie['header']);
        }
        $this->setCurlURL("http://www.google.com.au");
        $result = $this->sendCurl();
        dump($result);
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

    private function getCookie()
    {
        if (isset($this->options['cookie']) && is_array($this->options['cookie'])) {
            return $this->options['cookie'];
        }
        return false;
    }
}
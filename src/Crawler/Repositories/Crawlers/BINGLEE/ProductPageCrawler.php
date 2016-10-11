<?php
namespace Invigor\Crawler\Repositories\Crawlers\BINGLEE;

use Invigor\Crawler\Contracts\CrawlerInterface;
use Invigor\Crawler\Traits\Curler;

/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 10/11/2016
 * Time: 5:10 PM
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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.binglee.com.au");

        $curlHeaders = array(
            'Accept-Language: en-us',
            'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.15) Gecko/20110303 Firefox/3.6.15',
            'Connection: Keep-Alive',
            'Cache-Control: no-cache',
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $buffer = curl_exec($ch);

        curl_close($ch);

        preg_match('/^Set-Cookie: (.*?);/m', $buffer, $m);
        $postData = $m[1];
        dump($postData);
        dump($this->getURL());

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getURL());

        $curlHeaders = array(
            'Accept-Language: en-us',
            'Content-type: application/x-www-form-urlencoded;charset=UTF-8',
            'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.15) Gecko/20110303 Firefox/3.6.15',
            'Connection: Keep-Alive',
            'Cache-Control: no-cache',
            'Host: www.binglee.com.au',
            'Cookie:' . $postData
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $buffer = curl_exec($ch);

        curl_close($ch);

        $this->html = $buffer;
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

    private function getURL()
    {
        if (isset($this->options['url'])) {
            return $this->options['url'];
        }
        return null;
    }
}
<?php
namespace Invigor\Crawler\Repositories\Crawlers\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Invigor\Crawler\Contracts\CrawlerInterface;

class WaitTenSeconds implements CrawlerInterface
{

    protected $html = "";
    protected $options = array();
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
        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $capabilities = DesiredCapabilities::firefox();
        $driver = RemoteWebDriver::create($host, $capabilities, 5000, 500000);

// navigate to 'http://docs.seleniumhq.org/'
        $driver->get('http://www.google.com.au');

        $driver->wait(10, 500);

        $this->html = $driver->getPageSource();

        $driver->quit();
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
}
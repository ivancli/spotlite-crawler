<?php
namespace Invigor\Crawler\Contracts;
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 9/12/2016
 * Time: 10:27 AM
 */
interface CrawlerInterface
{

    /**
     * @return array
     */
    public function getOptions();

    /**
     * @param $options
     */
    public function setOptions($options);

    /**
     * Get HTML code from variable
     *
     * @return mixed
     */
    public function getHTML();

    /**
     * Load HTML code from web
     *
     * @param $options
     * @return mixed
     */
    public function loadHTML();

    /**
     * Get HTML code from cache
     *
     * @param $key
     * @return mixed
     */
    public function getCachedHTML($key);

    /**
     * Set HTML code to cache
     *
     * @param $options
     * @return mixed
     */
    public function setCachedHTML($options);

    /**
     * Remove HTML code from cache
     *
     * @param $key
     * @return mixed
     */
    public function removeCachedHTML($key);
}
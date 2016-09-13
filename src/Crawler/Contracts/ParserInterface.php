<?php
namespace Invigor\Crawler\Contracts;
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 9/12/2016
 * Time: 10:27 AM
 */
interface ParserInterface
{
    public function setOptions($options);

    public function setHTML($html);

    public function getOption($key);

    public function init();

    public function parseHTML();
}
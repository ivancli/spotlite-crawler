<?php
namespace Invigor\Crawler\Repositories\Parsers\COLES;

use Invigor\Crawler\Contracts\ParserInterface;

/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 10/12/2016
 * Time: 1:49 PM
 */
class ProductPagePriceParser implements ParserInterface
{
    protected $html;
    protected $options;

    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function setHTML($html)
    {
        $this->html = $html;
    }

    public function getHTML()
    {
        return $this->html;
    }

    public function getOption($key)
    {
        if (isset($this->options[$key])) {
            return $this->options[$key];
        }
        return null;
    }

    public function init()
    {
        // TODO: Implement init() method.
    }

    public function parseHTML()
    {
        if (!is_null($this->html)) {
            $productInfo = json_decode($this->html);
            if (isset($productInfo->catalogEntryView) && isset($productInfo->catalogEntryView[0]) && isset($productInfo->catalogEntryView[0]->p1) && isset($productInfo->catalogEntryView[0]->p1->o)) {
                return $productInfo->catalogEntryView[0]->p1->o;
            } else {
                return false;
            }
        }
    }
}
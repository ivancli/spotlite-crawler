<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 9/13/2016
 * Time: 1:04 PM
 */

namespace Invigor\Crawler\Repositories\Parsers;


use Invigor\Crawler\Contracts\ParserInterface;

class XPathParser implements ParserInterface
{
    protected $options;
    private $html;
    private $dom;
    private $xpathDom;

    public function __construct()
    {
        libxml_use_internal_errors(true);
    }

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
        $this->dom = new \DOMDocument();
    }

    public function parseHTML()
    {
        $this->dom->loadHTML($this->getHTML());
        $this->xpathDom = new \DOMXPath($this->dom);
        if (!is_null($this->getOption('xpath'))) {
            $xpath = $this->getOption('xpath');
            $result = $this->xpathDom->query($xpath);
            if ($result->length > 0) {
                foreach ($result as $tag) {
                    if (trim($tag->nodeValue) != "") {
                        return $tag->nodeValue;
                    } else {
                        return $this->dom->saveHTML($tag);
                    }
                }
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
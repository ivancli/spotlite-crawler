<?php
namespace Invigor\Crawler\Repositories\Parsers\JBHIFI;
use Invigor\Crawler\Contracts\ParserInterface;
use Invigor\Crawler\Repositories\Parsers\XPathParser;

/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 9/29/2016
 * Time: 2:24 PM
 */
class ProductPagePriceParser implements ParserInterface
{
    protected $options;
    private $html;
    private $dom;
    private $xpathDom;

    private $productIdxPath = "//input[contains(@class,'hiddenProductId')][1]";

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
        $xPathParser = new XPathParser();
        $this->dom->loadHTML($this->getHTML());
        $this->xpathDom = new \DOMXPath($this->dom);
        $result = $this->xpathDom->query($this->productIdxPath);
        if(!is_null($result) && $result != false){
            $Id = $result->item(0)->getAttribute("value");
            $Ids = array($Id);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://products.jbhifi.com.au/product/GetPrices");

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(compact(['Ids'])));
            $curlHeaders = array();
            $curlHeaders[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $buffer = curl_exec($ch);
            curl_close($ch);

            $buffer = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $buffer);
            $result = json_decode($buffer);
            if(isset($result->Result)){
                return ($result->Result[0]->DisplayPrice);
            }
        }

    }
}
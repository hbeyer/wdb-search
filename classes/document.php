<?php

class document {

    public $id;
    public $url;
    public $urlMain;
    public $urlXML;
    protected $html = '';
    public $header = '';
    public $indexUnits = array();
    public $errorMessages = array();

    function __construct($url, $urlMain = '', $urlXML = '') {     
        $this->url = $url;
        $this->urlMain = $urlMain;
        $this->urlXML = $urlXML;
    }

    public function load($cached = true) {
        $this->getContent($cached);
        $this->getHeader($cached);
        if ($this->errorMessages != array()) {
            echo implode("\r\n", $this->errorMessages);
        }
    }

    public function getContent() {
    }

    public function makeIndexUnits($metadataSet = null) {
    }

   protected function makeAssocByMilestone($delimiterExpr) {
        $pieces = preg_split($delimiterExpr, $this->html, -1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
        $index['#'] = array_shift($pieces);
        $key = null;
        foreach ($pieces as $value) {
            if ($key === null) {
                $key = '#'.$value;
            }
            else {
                $index[$key] = $value;
                $key = null;
            }
        }
        return($index);
    }    

    //Auf protected umstellen
    public function makeAssocByElement($tagName, $attrName, $filter) {
        $index = array();
        $dom = new DOMDocument;
        $dom->loadHTML($this->html);
        $nodes = $dom->getElementsByTagName($tagName);
        foreach ($nodes as $node) {
            $attributeNodes = $node->attributes;
            foreach ($attributeNodes as $attributeNode) {
                if ($attributeNode->nodeName == $attrName and $filter($attributeNode->nodeValue) == true) {
                    $index['#'.$attributeNode->nodeValue] = $dom->saveHTML($node);
                }
            }
        }
        return($index);
    }    

    public function getHeader($cached = true) {
        if (!$this->urlXML) {
            return;
        }
        $pathCache = 'cache/xml/'.$this->id.'.xml';
        if ($cached == true and file_exists($pathCache)) {
            $this->header = file_get_contents($pathCache);
            return;
        }
        $string = file_get_contents($this->urlXML);
        if (!$string) {
            $this->errorMessages[] = $this->urlXML.' konnte nicht geladen werden';
            return;
        }
        $doc = new DOMDocument();
        $doc->loadXML($string, LIBXML_NOERROR|LIBXML_NOWARNING);
        unset($string);
        $headerNode = $doc->getElementsByTagName('teiHeader')->item(0);
        $this->header = $doc->saveXML($headerNode);
        // Das Folgende ist notwendig, weil der nicht definierte Namespace xi sonst beim erneuten Laden in ein DOMDocument eine Fehlermeldung hervorrufft
        $this->header = preg_replace('~<xi:include [^>]+>~', '', $this->header);
        //$this->header = preg_replace('~<listPerson .+</listPerson>~', '', $this->header);
        //$this->header = preg_replace('~<listBibl .+</listBibl>~', '', $this->header);
        file_put_contents($pathCache, $this->header);
     }

}

?>

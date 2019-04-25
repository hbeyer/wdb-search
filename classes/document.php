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
        $this->getContent();
        $this->getHeader();
    }

    public function getContent() {
    }

    public function makeIndexUnits($metadataSet = null) {
    }

    protected function makeAssocAName($prefix = '') {
        $pieces = preg_split('~<a name="'.$prefix.'([0-9]+)">\s?</a>~' , $this->html, -1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
        $index = convertSplitArray($pieces, $prefix);
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
        $doc = new DOMDocument();
        $doc->loadXML($string);
        unset($string);
        $headerNode = $doc->getElementsByTagName('teiHeader')->item(0);
        $this->header = $doc->saveXML($headerNode);
        // Das Folgende ist notwendig, weil der nicht definierte Namespace xi sonst beim erneuten Laden in ein DOMDocument eine Fehlermeldung hervorrufft
        $this->header = preg_replace('~<xi:include [^>]+>~', '', $this->header);
        file_put_contents($pathCache, $this->header);
     }

}

?>

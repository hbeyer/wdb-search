<?php

class document {

    public $url;
    public $pathMain;
    public $pathXML;
    protected $html = '';
    public $header = '';
    public $indexUnits = array();
    public $errorMessages = array();

    function __construct($url, $pathMain = '', $pathXML = '') {     
        $this->url = $url;
        $this->pathMain = $pathMain;
        $this->pathXML = $pathXML;
    }

    public function load() {
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

    public function getHeader() {
        if (!$this->pathXML) {
            return;
        }
        $string = file_get_contents($this->pathXML);
        $doc = new DOMDocument();
        $doc->loadXML($string);
        unset($string);
        $headerNode = $doc->getElementsByTagName('teiHeader')->item(0);
        $this->header = $doc->saveXML($headerNode);
        // Das Folgende ist notwendig, weil der nicht definierte Namespace xi sonst beim erneuten Laden in ein DOMDocument eine Fehlermeldung hervorrufft
        $this->header = preg_replace('~<xi:include [^>]+>~', '', $this->header);
     }

}

?>

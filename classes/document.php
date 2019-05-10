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

    public function getContent($cached = true) {
        $pathCache = 'cache/html/'.$this->id.'.htm';
        if ($cached == true and file_exists($pathCache)) {
            $this->html = file_get_contents($pathCache);
            return;
        }
        $string = file_get_contents($this->urlMain);
        if (strlen($string) < 50) {
            $this->errorMessages[] = $this->urlMain.' konnte nicht geladen werden';
            return;
        }
        $doc = new DOMDocument();
        $doc->loadHTML($string, LIBXML_NOERROR);
        unset($string);
        $xpath = new DOMXpath($doc);
        $contentNode = $xpath->query("//div[@id='content']")->item(0);
        $this->html = $doc->saveHTML($contentNode);
        file_put_contents($pathCache, $this->html);
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

    protected function makeAssocByElement($tagName, $attrName, $filter) {
        //Das Folgende dient der Festlegung der Zeichencodierung
        $this->html = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>'.$this->html.'</body></html>';
        $index = array();
        $dom = new DOMDocument;
        $dom->loadHTML($this->html, LIBXML_NOERROR);
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
        if (strlen($string) < 50) {
            $this->errorMessages[] = $this->urlXML." konnte nicht geladen werden\r\n";
            return;
        }
        $string = preg_replace('~<xi:include [^>]+>~', '', $string);
        $doc = new DOMHeader;
        $doc->loadXML($string, LIBXML_NOERROR);
        unset($string);
        $doc->removeElements(array('listPlace', 'listPerson', 'listBibl'));
        $headerNode = $doc->getElementsByTagName('teiHeader')->item(0);
        $this->header = $doc->saveXML($headerNode);
        if (strlen($this->header) < 50) {
            $this->errorMessages[] = $this->id." konnte nicht geladen werden\r\n";
            return;   
        }
        file_put_contents($pathCache, $this->header);
     }

    protected function processText($index, $blanks = false) {
        if ($blanks == true) {
            $index = array_map('document::insertAdditionalBlanks', $index);
        }
        $index = array_map('strip_tags', $index);
        $index = array_map('document::removeArrows', $index);
        $index = array_map('document::normalizeSpace', $index);
        $index = array_map('trim', $index);
        return($index);
    }

    static function normalizeSpace($string) {
        $result = preg_replace('/\s+/', ' ', $string);
        return($result);
    }

    static function insertAdditionalBlanks($string) {
        $result = strtr($string, array('<a href="javascript:void(0)' => ' <a href="javascript:void(0)'));
        return($result);
    }

    static function removeArrows($string) {
        $translation = array('<' => '', '>' => '', '&lt;' => '', '&gt;' => '', '⟨' => '', '⟩' => '');
        return(strtr($string, $translation));
    }

}

?>
<?php

class document_loader {

    public $edoc;
    private $mets;
    

    function __construct($edoc) {
        $this->edoc = $edoc;
    }

    function getDocuments() {
    	$documents = array();
        // loadDocumentsMETS() einbauen
        return($documents);
    }

    // Hierfür muss die Logik der METS-Datei verstanden sein
    private function loadDocumentsMETS() {
        $string = file_get_contents($this->mets);
        $dom = new DOMDocument();
        $dom->loadXML($string);
        unset($string);
        $nodes = $dom->getElementsByTagNameNS('http://www.loc.gov/METS/', 'behavior');
        foreach ($nodes as $node) {
            foreach ($node->attributes as $attrNode) {
                if ($attrNode->nodeName == '')
                echo $attrNode->nodeName.': '.$attrNode->nodeValue."\r\n";
            }
        }
    }


}

?>

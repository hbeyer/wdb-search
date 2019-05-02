<?php

class document_loader {

    public $edoc;
    private $mets;
    
    function __construct($edoc, $mets = '') {
        $this->edoc = $edoc;
        $this->mets = $mets;
    }

    public function getDocuments() {
    }

    protected function loadMETSDOM() {
        $string = file_get_contents($this->mets);
        $dom = new DOMDocument();
        $dom->loadXML($string);
        unset($string);
        return($dom);
    }


}

?>

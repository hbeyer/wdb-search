<?php

class edition {

    public $edoc;
    public $type;
    private $mets;
    private $documents = array();
    
    function __construct($edoc, $type = 'default') {

        $this->edoc = $edoc;
        $this->mets = 'http://diglib.hab.de/edoc/ed'.$this->edoc.'/mets.xml';
        $this->type = $type;
        if ($this->type == 'christian2') {
            $loader = new document_loader_c2($this->edoc);
        }
        elseif ($this->type == 'default') {
            $loader = new document_loader($this->edoc);
        }
        $this->documents = $loader->getDocuments();
        
    }

    public function extractIndexUnits(index_repository $index_repository) {
        while ($document = array_shift($this->documents)) {
            $document->load();
            $document->getHeader();
            $metadataSet = new metadata_set($document->header);
            $document->makeIndexUnits($metadataSet);
            $index_repository->addUnits($document->indexUnits);
        }
    }

}

?>

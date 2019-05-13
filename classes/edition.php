<?php

class edition {

    public $edoc;
    public $type;
    public $title;
    private $mets;
    private $documents = array();
    
    function __construct($edoc, $type = 'default', $title = '', $mets = '') {

        $this->edoc = $edoc;
        $this->title = $title;
        $this->mets = $mets;
        if ($this->mets == '') {
        	$this->mets = 'http://diglib.hab.de/edoc/ed'.$this->edoc.'/mets.xml';
        }
        $this->type = $type;
        if ($this->type == 'christian2') {
            $loader = new document_loader_christian2($this->edoc);
        }
        elseif ($this->type == 'karlstadt') {
        	$loader = new document_loader_karlstadt($this->edoc, $this->mets);
        }
        elseif ($this->type == 'zenturien') {
        	$loader = new document_loader_zenturien($this->edoc, $this->mets);
        }        
        elseif ($this->type == 'default') {
            $loader = new document_loader($this->edoc);
        }
        $this->documents = $loader->getDocuments();
        
    }

    public function loadToCache() {
    	while ($document = array_shift($this->documents)) {
    		$document->load();
    	}
    }

    public function extractIndexUnits(index_repository $index_repository) {
        while ($document = array_shift($this->documents)) {
            $document->load();
            $metadataSet = new metadata_set($document->header);
            $metadataSet->addField(new field('edoc', $this->edoc));
            if ($this->title) {
                $metadataSet->addField(new field('titleEdition', $this->title));
            }
            $document->makeIndexUnits($metadataSet);
            $index_repository->addUnits($document->indexUnits);
        }
    }

}

?>

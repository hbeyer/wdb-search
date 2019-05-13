<?php

class index_unit {

    private $url;
    private $hash;
    public $content = array();

    function __construct($url, $hash) {
    	$this->url = $url;
    	$this->hash = $hash;
    }

    public function addField(field $field) {
        $this->content[] = $field;
    }

    public function addMetadataSet(metadata_set $metadataSet) {
    	$this->content = array_merge($this->content, $metadataSet->content);
    }

    public function fullURL() {
        if (substr($this->hash, 0, 1) != '#') {
            $this->hash = '#'.$this->hash;
        }
        return($this->url.$this->hash);
    }

    // Diese Lösung greift nur im Fall, dass das ganze Dokument eine Indexeinheit ist
    public function addHeadings($document, $blanks = false) {
        $headings = $document->extractHeadings($document->html, function($headings) { 
            $headings = array_diff($headings, array('Kritischer Apparat', 'Sachapparat'));
            return($headings); 
        });
        if (is_array($headings)) {
            $headings = $document->processText($headings, $blanks);
            foreach ($headings as $heading) {
                $field = new field('heading', $heading);
                $this->addField($field);
            }
        }        
    }    
    
}

?>

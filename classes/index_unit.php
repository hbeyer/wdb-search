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
    
}

?>

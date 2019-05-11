<?php

class document_zenturien extends document {

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
        $bodyNode = $doc->getElementsByTagName('body')->item(0);
        $this->html = $doc->saveHTML($bodyNode);
        file_put_contents($pathCache, $this->html);
    }

    public function makeIndexUnits($metadataSet = null) {
        $index = $this->makeAssocByElement('div', 'id',
            function($id) {
            $exclude = array('content', 'kritApp', 'FußnotenApparat');
            if (in_array($id, $exclude)) { 
                return(false); 
            }
                return(true);
            }
        );
        $assocIndex = $this->processText($index);
        foreach ($assocIndex as $key => $value) {
            $unit = new index_unit($this->urlMain, $key);
            if ($metadataSet != null) {
                $unit->addMetadataSet($metadataSet);
            }
            $field = new field('fullText', $value);
            $unit->addField($field);
            $this->indexUnits[] = $unit;
        }
        $this->html = '';
        return($this->indexUnits);
    }

}

?>
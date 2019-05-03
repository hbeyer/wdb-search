<?php

class document_karlstadt extends document {

    public function getContent($cached = true) {
        $pathCache = 'cache/html/'.$this->id.'.htm';
        if ($cached == true and file_exists($pathCache)) {
            $this->html = file_get_contents($pathCache);
            return;
        }
        $string = file_get_contents($this->urlMain);
        if (!$string) {
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
        $index = $this->makeAssocByElement('div', 'id',
            function($id) {
            $exclude = array('content');
            if (in_array($id, $exclude)) { 
                return(false); 
            }
                return(true);
            }
        );
        $assocIndex1 = processText($index);
        foreach ($assocIndex1 as $key => $value) {
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
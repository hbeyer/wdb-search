<?php

class document_c2 extends document {

    public function getContent($cached = true) {
        $pathCache = 'cache/html/'.$this->id.'.htm';
        if ($cached == true and file_exists($pathCache)) {
            $this->html = file_get_contents($pathCache);
            return;
        }
        $string = file_get_contents($this->urlMain);
        $doc = new DOMDocument();
        $doc->loadHTML($string, LIBXML_NOERROR);
        unset($string);        
        $xpath = new DOMXpath($doc);
        $contentNode = $xpath->query("//div[@class='content']")->item(0);
        $this->html = $doc->saveHTML($contentNode);
        file_put_contents($pathCache, $this->html);
    }

    public function makeIndexUnits($metadataSet = null) {
        $assocIndex = $this->makeAssocAName($prefix = 'hd');
        $assocIndex1 = processText($assocIndex);
        $assocIndex2 = processText($assocIndex, true);
        foreach ($assocIndex1 as $key => $value) {
            $unit = new index_unit($this->urlMain, $key);
            if ($metadataSet != null) {
                $unit->addMetadataSet($metadataSet);
            }
            $field = new field('fullText', $value);
            $unit->addField($field);
            $field = new field('fullText-alt', $assocIndex2[$key]);
            $unit->addField($field);
            $this->indexUnits[] = $unit;
        }
        $this->html = '';
        return($this->indexUnits);
    }


}

?>

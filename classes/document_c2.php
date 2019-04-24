<?php

class document_c2 extends document {

    public function getContent() {
        $string = file_get_contents($this->pathMain);
        $doc = new DOMDocument();
        $doc->loadHTML($string, LIBXML_NOERROR);
        unset($string);        
        $xpath = new DOMXpath($doc);
        $contentNode = $xpath->query("//div[@class='content']")->item(0);
        $this->html = $doc->saveHTML($contentNode);
    }

    public function makeIndexUnits($metadataSet = null) {
        $assocIndex = $this->makeAssocAName($prefix = 'hd');
        $assocIndex1 = processText($assocIndex);
        $assocIndex2 = processText($assocIndex, true);
        foreach ($assocIndex1 as $key => $value) {
            $unit = new index_unit($this->pathMain, $key);
            if ($metadataSet != null) {
                $unit->addMetadataSet($metadataSet);
            }
            $field = new field('fullText', $value);
            $unit->addField($field);
            $field = new field('fullText', $assocIndex2[$key]);
            $unit->addField($field);
            $this->indexUnits[] = $unit;
        }
        $this->html = '';
        return($this->indexUnits);
    }


}

?>

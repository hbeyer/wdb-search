<?php

class document_karlstadt extends document {

    public function makeIndexUnits($metadataSet = null) {
        $this->preprocessText();
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

    protected function preprocessText() {
        $this->html = document::convertEt($this->html);
        $this->html = strtr($this->html, array('class="fn_number">' => 'class="fn_number"> ', '<br>' => ' ', "'" => ""));
        //$this->html = preg_replace("~([A-Za-z])'([A-Za-z])~", '$1$2', $this->html);
    }     

}

?>
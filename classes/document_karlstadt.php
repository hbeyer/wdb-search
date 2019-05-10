<?php

class document_karlstadt extends document {

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
<?php

class DOMHeader extends DOMDocument {

    public function removeElements($elements) {
        $domElemsToRemove = array();
        foreach ($elements as $nodeName) {
            $domNodeList = $this->getElementsByTagname($nodeName);
            foreach ($domNodeList as $domElement) {
                $domElemsToRemove[] = $domElement;
            }   
        }
        foreach($domElemsToRemove as $domElement) {
            $domElement->parentNode->removeChild($domElement);
        }
    }
	
}

?>
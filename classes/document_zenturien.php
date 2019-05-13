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
    	$this->preprocessText();

    	$unit = new index_unit($this->urlMain, '#');

        if ($metadataSet != null) {
            $unit->addMetadataSet($metadataSet);
        }

	    //$unit->addHeadings($this, true);

    	$index = array('#' => $this->html);
    	$fullText = $this->processText($index)['#'];
    	$field = new field('fullText', $fullText);
		$unit->addField($field);

        $this->indexUnits[] = $unit;
    }

    protected function preprocessText() {
    	$this->html = document::convertEt($this->html);
    	$this->html = strtr($this->html, array('<span class="fnz">' => ' <span class="fnz">', '<br>' => ' '));
    } 

}

?>
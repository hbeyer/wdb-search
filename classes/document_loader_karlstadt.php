<?php

class document_loader_karlstadt extends document_loader {

    public function getDocuments() {
    	$documents = array();
    	$dom = $this->loadMETSDOM();
    	$xp = new DOMXPath($dom);
    	$nodes = $xp->query('//mets:fileGrp[@USE="transcription" or @USE="intro"]/mets:file/@ID');
    	foreach ($nodes as $node) {
    		$html = $node->textContent;
    		$xml = $xp->query('parent::mets:file/mets:FLocat/@xlink:href', $node)->item(0)->textContent;
    		if ($html and $xml) {
    			$doc = new document_karlstadt('http://diglib.hab.de/edoc/ed'.$this->edoc.'/start.htm', 'http://dev2.hab.de/edoc/view.html?id='.$html, 'http://dev2.hab.de/edoc/ed'.$this->edoc.'/'.$xml);
    			$id = strtr($html, array('edoc_ed' => '', '_transcript' => ''));
    			$doc->id = $id;
    			$documents[] = $doc;
    		}
    	}
    	return($documents);
    }

}

?>

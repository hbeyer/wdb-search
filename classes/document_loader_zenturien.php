<?php

class document_loader_zenturien extends document_loader {

    public function getDocuments() {
        $documents = array();
        $dom = $this->loadMETSDOM();
        $xp = new DOMXPath($dom);
        $nodes = $xp->query('//mets:fileGrp[@USE="transcript"]/mets:file/mets:FLocat/@xlink:href');
        foreach ($nodes as $node) {
            $xml = $node->textContent;
            if ($xml) {
                $doc = new document_zenturien('http://diglib.hab.de/edoc/ed'.$this->edoc.'/start.htm', 'http://diglib.hab.de/content.php?dir=edoc/ed'.$this->edoc.'&distype=optional&xml='.$xml.'&xsl=tei-transcript.xsl', 'http://diglib.hab.de/edoc/ed'.$this->edoc.'/'.$xml);
                $doc->id = $this->edoc.'_'.strtr(substr($xml, 0, -4), '/', '_');
                $documents[] = $doc;
            }
        }
        return($documents);
    }


}

?>

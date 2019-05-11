<?php

class document_loader {

    public $edoc;
    private $mets;
    
    function __construct($edoc, $mets = '') {
        $this->edoc = $edoc;
        $this->mets = $mets;
    }

    public function getDocuments() {
        $documents = array();
        $dom = $this->loadMETSDOM();
        $xp = new DOMXPath($dom);
        $nodes = $xp->query('//mets:fileGrp[@USE="transcription" or @USE="intro"]/mets:file/@ID');
        foreach ($nodes as $node) {
            $html = $node->textContent;
            $xml = $xp->query('parent::mets:file/mets:FLocat/@xlink:href', $node)->item(0)->textContent;
            if ($html and $xml) {
                $doc = new document('http://diglib.hab.de/edoc/ed'.$this->edoc.'/start.htm', 'http://dev2.hab.de/edoc/view.html?id='.$html, 'http://dev2.hab.de/edoc/ed'.$this->edoc.'/'.$xml);
                $doc->id = strtr($html, array('edoc_ed' => '', '_transcript' => ''));
                $documents[] = $doc;
            }
        }
        return($documents);
    }

    protected function loadMETSDOM() {
        $string = file_get_contents($this->mets);
        $dom = new DOMDocument();
        $dom->loadXML($string);
        unset($string);
        return($dom);
    }


}

?>

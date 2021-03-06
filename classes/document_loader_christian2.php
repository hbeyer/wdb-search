<?php

class document_loader_christian2 extends document_loader {

	private $months = array(
	    '1621_11',
	    '1621_12', 
	    '1622_01',
	    '1622_02', 
	    '1622_10', 
	    '1622_11', 
	    '1622_12', 
	    '1623_01', 
	    '1623_02', 
	    '1623_03', 
	    '1623_04', 
	    '1623_05', 
	    '1623_06',
	    '1623_07',
	    '1623_08',
	    '1623_09',
	    '1623_10',
	    '1623_11',
	    '1626_05',
	    '1626_06',
	    '1626_07',
	    '1626_08',
	    '1626_09',
	    '1626_10',
	    '1626_11',
	    '1626_12',
	    '1627_01',
	    '1627_02',
	    '1627_03',
	    '1627_04',
	    '1627_05',
	    '1627_11',
	    '1627_12',
	    '1628_01',
	    '1628_02',
	    '1628_03',
	    '1628_04',
	    '1628_05',
	    '1628_06',
	    '1628_07',
	    '1628_08',
	    '1628_09',
	    '1628_10',
	    '1635_01',
	    '1635_02',
	    '1635_03',
	    '1635_04',
	    '1635_05',
	    '1635_06',
	    '1635_07',
	    '1635_08',
	    '1635_09',
	    '1635_10',
	    '1635_11',
	    '1635_12',
	    '1636_01',
	    '1636_02',
	    '1636_03',
	    '1636_04',
	    '1636_05',
	    '1636_06',
	    '1636_07',
	    '1636_08',
	    '1636_09',
	    '1636_10',
	    '1636_11',
	    '1636_12',
	    '1637_01',
	    '1637_02',
	    '1637_03',
	    '1637_04',
	    '1637_05',
	    '1637_06',
	    '1637_07',
	    '1637_08'
    );

    public function getDocuments() {
    	$documents = array();
    	foreach ($this->months as $month) {
    		$doc = new document_christian2('http://diglib.hab.de/edoc/ed'.$this->edoc.'/start.htm', 'http://diglib.hab.de/content.php?dir=edoc/ed'.$this->edoc.'&distype=optional&metsID=edoc_ed'.$this->edoc.'_fg_'.$month.'_sm&xml='.$month.'.xml&xsl=tei-transcript.xsl', 'http://diglib.hab.de/edoc/ed'.$this->edoc.'/'.$month.'.xml');
    		$doc->id = $this->edoc.'-'.$month;
    		$documents[] = $doc;
    	}
    	return($documents);
    }

}

?>

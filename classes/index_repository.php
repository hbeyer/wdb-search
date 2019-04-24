<?php

class index_repository {

	private $content = array();

	function __construct($units = null) {
		if ($units) {
			$this->addUnits($units);
		}
	}

	public function addUnits($units) {
		if (!empty($units[0])) {
			if (get_class($units[0]) == 'index_unit') {
				$this->content = array_merge($this->content, $units);
			}
		}
	}

	public function dumpToFile($fileName = 'indexPHP') {
		$data = serialize($this->content);
		file_put_contents($fileName, $data);
	}

	public function loadFromFile($fileName = 'indexPHP') {
		$data = file_get_contents($fileName);
		$this->content = array_merge($this->content, unserialize($data));
	}

	public function serializeSolrXML($fileName = 'index-solr.xml') {
		$dom = new DOMDocument('1.0', 'UTF-8');
		$dom->formatOutput = true;
		$rootElement = $dom->createElement('add');
		foreach ($this->content as $unit) {
			$unitElement = $dom->createElement('doc');
			$fieldElement = $this->makeFieldElement($dom, 'url', $unit->fullURL());
			$unitElement->appendChild($fieldElement);
			foreach ($unit->content as $field) {
				$fieldElement = $this->makeFieldElement($dom, $field->name, $field->value);
				$unitElement->appendChild($fieldElement);				
			}
			$rootElement->appendChild($unitElement);
		}
		$dom->appendChild($rootElement);
		$string = $dom->saveXML();
		file_put_contents($fileName, $string);
	}

	private function makeFieldElement(DOMDocument $dom, $key, $value) {
		$fieldElement = $dom->createElement('field');
		$fieldContent = $dom->createTextNode($value);
		$fieldElement->appendChild($fieldContent);
		$fieldAttribute = $dom->createAttribute('name');
		$fieldAttribute->value = $key;
		$fieldElement->appendChild($fieldAttribute);
		return($fieldElement);
	}

}

?>
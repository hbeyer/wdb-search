<?php

class metadata_set {

	private $doc;
	private $xp;

	public $content = array();
	
	private $simpleFields = array(
		'title' => '//titleStmt/title',
		'date' => '//titleStmt/title/date/@when',
		'funder' => '//titleStmt/funder'
	);
	private $personFields = array(
		'name' => 'descendant::name',
		'nameLink' => 'descendant::nameLink',
		'forename' => 'descendant::forename',
		'surname' => 'descendant::surname',
		'resp' => 'descendant::resp',
		//'fullName' => 'self::*'
	);

	function __construct($header) {
		$this->doc = new DOMHeader();
		$this->doc->loadXML($header, LIBXML_NOERROR);
		unset($header);
		$this->xp = new DOMXPath($this->doc);
		foreach ($this->simpleFields as $fieldName => $path) {
			$nodes = $this->xp->query($path);
			foreach ($nodes as $node) {
				$field = new field($fieldName, document::normalizeSpace($node->textContent));
				$this->addField($field);
			}
		}
		$this->addPersons('//titleStmt/author', 'author');
		$this->addPersons('//respStmt', 'editor');
		$this->doc = null;
		$this->xp = null;
	}

	private function addPersons($expr, $role) {
		$personNodes = $this->xp->query($expr);
		foreach ($personNodes as $contextNode) {
			$person = new person;
			foreach ($this->personFields as $field => $path) {
				$singleNode = $this->xp->query($path, $contextNode)->item(0);
				if ($singleNode) {
					$person->$field = trim($singleNode->textContent);
				}
			}
			$metadataField = new field($role, $person->__toString());
			$this->addField($metadataField);
		}
	}

	public function addField(field $field) {
		if ($field->valid == false) {
			return;
		}
		$this->content[] = $field;
	}

}

?>
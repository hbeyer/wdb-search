<?php

class person {
	
	public $name;
	public $nameLink;
	public $forename;
	public $surname;
	public $fullName;
	public $resp;

	function __toString() {
		$return = '';
		if ($this->forename and $this->surname) {
			$return = $this->forename.' '.$this->surname;
		}
		elseif ($this->name and $this->nameLink and $this->surname) {
			$nameArray = array($this->name, $this->nameLink, $this->surname);
			$return = implode(' ', $nameArray);
		}
		elseif($this->fullName) {
			$return = $this->fullName;
		}
		if ($this->resp) {
			$return = $this->resp.' '.$return;
		}
		return($return);
	}

}

?>
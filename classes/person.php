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
		if($this->fullName) {
			$return = $this->fullName;
		}
		elseif ($this->forename and $this->surname) {
			$return = $this->forename.' '.$this->surname;
		}
		else {
			$nameArray = array($this->name, $this->nameLink, $this->surname);
			$return = implode(' ', $nameArray);
		}
		if ($this->resp) {
			$return = $this->resp.' '.$return;
		}
		return($return);
	}

}

?>
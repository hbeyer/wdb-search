<?php

class field {

    public $name;
    public $value;
    public $valid = false;

    function __construct($name, $value) {
        $this->name = $name;
        $this->value = $value;
        $this->validate();
    }

    function validate() {   
        if (!is_string($this->name) or !is_string($this->value)) {
            return;
        }
        if ($this->name == '') {
            return;
        }
        $this->valid = true;        
    }

}

?>

<?php

class MY_Controller extends CI_Controller {

    var $data;
    var $debug = false;

    function __construct() {
        parent::__construct();
    }

    protected function printPre($data, $die=false) {
        echo "<pre>".print_r($data, true)."</pre>";
        if ($die)
           die();
    }

    protected function printPreDebug($title, $data, $die=false) {
        if ($this->debug) {
            echo "$title:<br/>";
            $this->printPre($data, $die);
        }
    }
}

?>

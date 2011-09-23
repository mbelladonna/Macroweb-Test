<?php

class MY_Controller extends CI_Controller {

    var $data;

    function __construct() {
        parent::__construct();
    }

    protected function print_pre($data, $die=false) {
        echo "<pre>".print_r($data, true)."</pre>";
        if ($die)
           die();
    }
}

?>

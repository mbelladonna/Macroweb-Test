<?php

class smsender_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function saveRequest($params) {
        $this->db->insert('requests', $params);
        return $this->db->insert_id();
    }

}

?>

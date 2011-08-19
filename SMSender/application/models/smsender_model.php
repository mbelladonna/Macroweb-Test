<?php

class smsender_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function loadRequest($where) {
        $query = $this->db->get_where('requests', $where); 
        return $query->result();
    }

    function saveRequest($params) {
        $this->db->insert('requests', $params);
        return $this->db->insert_id();
    }
    
    function saveCheckpinRequest($params){
        $this->db->insert('check_pin_requests', $params);
    }
    
    function saveSendMessageRequest($params){
        $this->db->insert('send_message_requests', $params);
    }

}

?>

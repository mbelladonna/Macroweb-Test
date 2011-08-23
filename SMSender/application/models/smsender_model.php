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
    
    // Actualizar datos de la tabla requests para determinado id
    function updateRequest($id,$params) {
        $this->db->where('id', $id);
        $this->db->update('requests', $params); 
    }
    
    function saveCheckUserRequest($params) {
        $this->db->insert('check_user_requests', $params);
    }
    
    function saveSendPinRequest($params) {
        $this->db->insert('send_pin_requests', $params);
    }
    
    function saveCheckpinRequest($params) {
        $this->db->insert('check_pin_requests', $params);
    }
    
    function saveSendMessageRequest($params) {
        $this->db->insert('send_message_requests', $params);
    }

    function countMessagesToday($nroMovil) {
        $this->db->select('count(request_id) AS msg_today');
        $this->db->from('requests AS R');
        $this->db->join('send_message_requests AS SMR', 'R.id=SMR.request_id');
        $this->db->where("DATE(NOW())=DATE(SMR.date) AND R.origen_subno='$nroMovil' AND send_message_response='200'");
        return $this->db->get()->row()->msg_today;
    }

}

?>

<?php

class pornoxmovil_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function saveTransactionsIdRequest($params) {
        $this->db->insert('requests_transaction_id', $params);
    }
    
    function transactionIdValid($id) {
		$sql = "SELECT transaction_id FROM requests_transaction_id WHERE transaction_id = '$id' AND  usado=0" ;
        $result = mysql_query($sql);
        return (mysql_num_rows($result)>0);
	}

    function useTransactionId($id) {
        $this->db->where('transaction_id', $id);
        $this->db->update('requests_transaction_id', array('usado' => 1)); 
    }
}

?>

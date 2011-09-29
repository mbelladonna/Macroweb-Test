<?php

class clubcontenidos_model extends CI_Model {

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
    
    function initUserCredits($movilUser) {
        $params = array(
                'movil' => $movilUser,
                'credits' => 0
            );
        $this->db->insert('user_credits', $params);
    }
    
    function incrementsUserCredits($movilUser, $cant){
        $this->db->set('credits',"credits+'$cant'");
        $this->db->where('movil',$movilUser);
        $this->db->update('user_credits'); 
    }
    
    function decrementsUserCredits($movilUser, $cant){
        $this->db->set('credits',"credits-'$cant'");
        $this->db->where('movil',$movilUser);
        $this->db->update('user_credits'); 
    }
    
    function getUserData($movil){
        $this->db->where('movil', $movil);
        $query = $this->db->get('user_credits'); 
        return $query->result();
    }
    
    function deleteUserCredits($movilUser){
        $this->db->where('movil', $movilUser);
        $this->db->delete('user_credits'); 
    }
    
    // Categorias principales $id_categ_parent=0
    function saveNewCategory($name,$desc,$id_categ_parent){
        $params = array(
                'id_parent' =>$id_categ_parent,
                'name' => $name,
                'description' => $desc
            );
        $this->db->insert('categories', $params);
        return $this->db->insert_id();
    }

    function updateCategory($id,$params) {
        $this->db->where('id_category', $id);
        $this->db->update('categories', $params); 
    }
    
    function getCategoryData($id){
        $this->db->select('name, description');
        $this->db->where('id_category', $id);
        $query = $this->db->get('categories'); 
        return $query->result();
    }
    
    function getMainCategories(){
        $this->db->where('id_parent', 0);
        $query = $this->db->get('categories'); 
        return $query->result();
    }
    
    function getSubCategories($categ_parent){
        $this->db->where('id_parent', $categ_parent);
        $query = $this->db->get('categories'); 
        return $query->result();
    }
        
    function getCategories(){
        $query = $this->db->get('categories'); 
        return $query->result();
    }
     
    function saveNewProduct($titulo,$desc, $categ,$foto,$textalt,$cred,$link){
        $params = array(
                'titulo' => $titulo,
                'descripcion' => $desc,
                'categoria_id' => $categ,
                'foto' => $foto,
                'text_alt' => $textalt,
                'creditos_nec' => $cred,
                'url_link' => $link,
                'downloads' => 0
                
            );
        $this->db->insert('products', $params);
        return $this->db->insert_id();
    }
    
    function updateProduct($id,$params) {
        $this->db->where('id', $id);
        $this->db->update('products', $params); 
    }
    
    function getProductData($id){
        $this->db->where('id', $id);
        $query = $this->db->get('products'); 
        return $query->result();
    }
    
    function getProducts(){
        $query = $this->db->get('products'); 
        return $query->result();
    }
    
    function getProductCategory($categ_id){
        $this->db->where('categoria_id', $categ_id);
        $query = $this->db->get('products'); 
        return $query->result();
    }
    
    //SELECT * FROM products ORDER BY `downloads` DESC 
    function getProductOrderByDownloads(){
        $this->db->order_by("downloads", "desc"); 
        $query = $this->db->get('products'); 
        return $query->result();
    }
    
    
    function saveDownloadRequest($movil,$prod_id, $cred) {
            $params = array(
                'movil' => $movil,
                'product_id' => $prod_id,
                'creditos_cons' => $cred,
            );
        $this->db->insert('download_request', $params);
        return $this->db->insert_id();
    }
    
    function getDownloadsUser($movil){
        $this->db->where('movil', $movil);
        $query = $this->db->get('download_request'); 
        return $query->result();
    } 
    
    
    

}

?>

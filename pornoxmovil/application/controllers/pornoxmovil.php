<?php
class Pornoxmovil extends CI_Controller {

	/* 
    ** Variables de configuracion
    */
    var $template = 'base';

	public function index()
	{
		//echo 'Controlador default';
		
		$this->data['page_title'] = 'Pornoxmovil.com';
		
		$this->data['content'] = $this->load->view('pornoxmovil/pornoxmovil', $this->data, TRUE);
        $this->load->view($this->template, $this->data);
		
	}
	
}
?>
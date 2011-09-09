<?php
class Pornoxmovil extends CI_Controller {

	/* 
    ** Variables de configuracion
    */
    var $template = 'base';

	public function index()
	{
		//echo 'Controlador default';
		
		$this->data['page_title'] = 'Pornoxmovil - ';
		
		$this->data['content'] = $this->load->view('Pornoxmovil/pornoxmovil', $this->data, TRUE);
        $this->load->view($this->template, $this->data);
		
	}
	
}
?>
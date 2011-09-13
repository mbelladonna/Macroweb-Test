<?php

class Pornoxmovil extends CI_Controller {

	/* 
    ** Variables de configuracion
    */
    var $template = 'base';

    private function _validPage($pagina){
        return $pagina == 1 || $pagina == 2 || $pagina == 3;
    }

	public function index()
	{
		$pagina = $this->input->get('page');
        $pagina = $this->_validPage($pagina) ? $pagina : 1;
		
        $this->data['pagina'] = $pagina;
		$this->data['page_title'] = 'Pornoxmovil.com';
		$this->data['content'] = $this->load->view("pornoxmovil/pornoxmovil_".$pagina, $this->data, TRUE);
        $this->load->view($this->template, $this->data);
	}
	
}

?>

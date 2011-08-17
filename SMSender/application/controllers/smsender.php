<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class smsender extends MY_Controller {

    var $template = 'base';

	public function index()
	{
        // $this->output->enable_profiler(TRUE);

        if ($this->input->post('data')){
            $data = $this->input->post('data');            
        }

        $this->data['content'] = $this->load->view('SMSender/smsender', $this->data, TRUE);
        $this->load->view($this->template, $this->data);
	}
}

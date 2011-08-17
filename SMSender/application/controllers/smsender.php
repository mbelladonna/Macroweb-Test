<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class smsender extends MY_Controller {

    var $template = 'base';
    var $campaign_id = 4;
    var $keyword = 'A1';
    var $gateway_url = '';
    var $send_pin_url = '';
    var $check_pin_url = '';

   function __construct() {
        parent::__construct();
        if (SITE_URL == 'local'){
            $this->gateway_url = 'http://localhost/Gateway-Pupolis/index.php/';
        }
        $this->send_pin_url = "{$this->gateway_url}gate/sendPin/AmBnZRF2QWf/{$this->keyword}/{$this->campaign_id}/";
        $this->check_pin_url = "{$this->gateway_url}gate/checkPin/AmBnZRF2QWf/{$this->keyword}/{$this->campaign_id}/";
    }

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

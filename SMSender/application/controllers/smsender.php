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
        $this->load->model(array('smsender_model'));
    }

	public function index() {
        // $this->output->enable_profiler(TRUE);
        
        // Procesamiento de datos de formulario
        if ($this->input->post('data')){

            $data = $this->input->post('data');

            // Solicitar al gw envio de pin a numero origen
            $params = array(
                'nroPhone' => $data['origen_subno'],
            );
            $response = $this->curl->_simple_call('get', $this->send_pin_url, $params);

            // Quitar comentarios para forzar rstas del gateway para pruebas
            // $response = '{"rsp":"ok"}'; //-- PIN enviado
            // $response = '{"rsp":"error"}'; //-- Error en envio
            // $response = FALSE; //-- Error en comunicacion con gw

            $request_row = array(
                'origen_subno' => $data['origen_subno'],
                'destino_subno' => $data['destino_subno'],
                'message' => $data['message'],
                'send_pin_response' => $response
            );
            $request_id = $this->smsender_model->saveRequest($request_row);

            if ($response != FALSE){
                $response = json_decode($response);                
                if ($response->rsp == 'ok') {
                    redirect("/smsender/checkPin/$request_id");    
                } else {
                    $this->data['error'] = 'Error al intentar enviar pin';
                }
            } else {
                $this->data['error'] = 'Error en comunicación con gateway';
            }
        }

        $this->data['content'] = $this->load->view('SMSender/smsender', $this->data, TRUE);
        $this->load->view($this->template, $this->data);
	}

    public function checkPin($id) {
        $this->data['id'] = $id;
        $this->data['content'] = $this->load->view('SMSender/checkpin', $this->data, TRUE);
        $this->load->view($this->template, $this->data);
    }
}

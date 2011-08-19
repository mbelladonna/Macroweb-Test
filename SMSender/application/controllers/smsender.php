<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class smsender extends MY_Controller {

    var $template = 'base';
    var $campaign_id = 4;
    var $keyword = 'A1';
    var $usr = 'querox s.l';
    var $pwd = 'sgB71SDf20';
    var $app = 'PUSH-ECO';
    var $sNumber = '';
    var $gateway_url = '';
    var $check_user_url = '';
    var $send_pin_url = '';
    var $check_pin_url = '';
    var $send_message_url = '';
    

   function __construct() {
        parent::__construct();
        if (SITE_URL == 'local'){
            $this->gateway_url = 'http://localhost/Gateway-Pupolis/index.php/';
        }
        $this->check_user_url  = "{$this->gateway_url}gate/userExist/AmBnZRF2QWf/";
        $this->send_pin_url = "{$this->gateway_url}gate/sendPin/AmBnZRF2QWf/{$this->keyword}/{$this->campaign_id}/";
        $this->check_pin_url = "{$this->gateway_url}gate/checkPin/AmBnZRF2QWf/{$this->keyword}/{$this->campaign_id}/";
        $this->send_message_url = "http://api.sms.egtelecom.es/pass/send.php";  
        $this->load->model(array('smsender_model'));
    }

	public function index() {
        // $this->output->enable_profiler(TRUE);
        
        // Procesamiento de datos de formulario
        if ($this->input->post('data')){

            $data = $this->input->post('data');
            
            $request_row = array(
                'origen_subno' => $data['origen_subno'],
                'password' => $data['password'],
                'destino_subno' => $data['destino_subno'],
                'message' => $data['message'],
            );
            $request_id = $this->smsender_model->saveRequest($request_row);
            
            
            // Chequeo de subscripción
            $paramscheck = array(
                'nroPhone' => $data['origen_subno'],
                'passwd' => $data['password'],
            );
            $responsecheck = $this->curl->_simple_call('get', $this->check_user_url, $paramscheck);
            
            // $responsecheck = '{"rsp":"ok"}'; //-- Existe el usuario
             $response = '{"rsp":"error"}'; //-- Error 
            // $response = FALSE; //-- Error en comunicacion con gw
            
            $checkuser_request_row = array(
                'request_id' => $request_id,
                'check_user_response' => $responsecheck
            );
            $this->smsender_model->saveCheckUserRequest($checkuser_request_row);
            
            
            if ($responsecheck != FALSE){
                $responsecheck = json_decode($responsecheck);                
                if ($responsecheck->rsp == 'ok') {
                    // Usuario subscripto. Mando mensaje.
                    redirect("/smsender/sendmessage/$request_id");     
                } else {
                    // Usuario no subscripto, paso a check pin
                    
                    // Solicitar al gw envio de pin a numero origen
                    $params = array(
                        'nroPhone' => $data['origen_subno'],
                    );
                    $response = $this->curl->_simple_call('get', $this->send_pin_url, $params);

                    // Quitar comentarios para forzar rstas del gateway para pruebas
                    $response = '{"rsp":"ok"}'; //-- PIN enviado
                    // $response = '{"rsp":"error"}'; //-- Error en envio
                    // $response = FALSE; //-- Error en comunicacion con gw
                    
                    
                    // -- Falta ver si guardo el send_pin_response
                    $sendpin_request_row = array(
                        'request_id' => $request_id,
                        'send_pin_response' => $response
                    );
                    $this->smsender_model->saveSendPinRequest($sendpin_request_row);
                    
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
            } else {
                $this->data['error'] = 'Error en comunicación con gateway';
            }
            
            
        }

        $this->data['content'] = $this->load->view('SMSender/smsender', $this->data, TRUE);
        $this->load->view($this->template, $this->data);
	}

    public function checkPin($id) {
        
        $params = array(
            'id' => $id
        );
        $request = $this->smsender_model->loadRequest($params);
        $this->data['request'] = $request[0];
                  
       
        // Obtengo  datos del formulario
        if ($this->input->post('data')){

            $data = $this->input->post('data');
            
            // Variables para chequeo de pin
            $params = array(
                'nroPhone' => $request[0]->origen_subno,
                'pin' => $data['pin_insert'],
            );
            $response = $this->curl->_simple_call('get', $this->check_pin_url, $params);
            
                       
            // Quitar comentarios para forzar rstas del gateway para pruebas
             $response = '{"rsp":"ok"}'; //-- PIN enviado
            // $response = '{"rsp":"error"}'; //-- Error en envio
            // $response = FALSE; //-- Error en comunicacion con gw

            // Salvar en la base de datos            
            $checkpin_request_row = array(
                'request_id' => $id,
                'pin' => $data['pin_insert'],
                'check_pin_response' => $response
            );
            $this->smsender_model->saveCheckpinRequest($checkpin_request_row);
            
            
            if ($response != FALSE){
                $response = json_decode($response);                
                if ($response->rsp == 'ok') {
                    // Mandar mensaje
                    redirect("/smsender/sendmessage/$id"); 
                } else {
                    $this->data['error'] = 'Error al chequear el pin';
                }
            } else {
                $this->data['error'] = 'Error en comunicación con gateway';
            }            
        }
        $this->data['content'] = $this->load->view('SMSender/checkpin', $this->data, TRUE);
        $this->load->view($this->template, $this->data);        
    }
    
    public function sendmessage($id) {
        
        $params = array(
            'id' => $id
        );
        $request = $this->smsender_model->loadRequest($params);
        $this->data['request'] = $request[0];
                  
       
        // Variables para envio del mensaje
        $params = array(
            'usr' => $this->usr,
            'pwd' => $this->pwd,
            'app' => $this->app,
            'sNumber' => $this->sNumber,
            'tNumber' => $request[0]->destino_subno,
            'mBody' => $request[0]->message,
        );
        
        //$response = $this->curl->_simple_call('post', $this->send_message_url, $params);
            
                       
        // Quitar comentarios para forzar rstas del gateway para pruebas
        $response = '200'; //-- mensaje enviado
        // $response = '400'; //-- Error 

        // Salvar sendmessage request            
        $sendmessage_request_row = array(
            'request_id' => $id,
            'send_message_response' => $response
        );
        $this->smsender_model->saveSendMessageRequest($sendmessage_request_row);
            
            
        if ($response == '200') {
            // Envio correcto del  mensaje
            $this->session->set_userdata ('message', 'Mensaje enviado correctamente.');
              
        } else {
            //$this->data['error'] = 'Error en el envio del mensaje.';
            $this->session->set_userdata ('message', 'Error en el envio del mensaje.');
        }
               
        redirect("/smsender/index"); 
    }
}
?>

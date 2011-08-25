<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class smsender extends MY_Controller {

    /* 
    ** Variables de configuracion
    */
    var $template = 'base';

    // Parametros para comunicacion con gateway-pupolis
    var $gateway_url = '';
    var $check_user_url = '';
    var $send_pin_url = '';
    var $check_pin_url = '';
    var $campaign_id = 344;
    var $keyword = 'sms';

    // Parametros para comunicacion con api eg-telecom
    var $send_message_url = 'http://api.sms.egtelecom.es/pass/send.php';
    var $usr = 'querox s.l';
    var $pwd = 'sgB71SDf20';
    var $app = 'PUSH-ECO';
    var $sNumber = '';

    // Otras
    var $limite_mensajes_diarios = 2;

   function __construct() {
        parent::__construct();
        if (SITE_URL == 'local'){
            $this->gateway_url = 'http://localhost/Gateway-Pupolis/index.php/';
        } elseif (SITE_URL == 'production') {
            $this->gateway_url = 'http://gate.pupolis.com/';
        } else {
            die("Error. SITE_URL invalido.");
        }
        $this->check_user_url  = "{$this->gateway_url}gate/userExist/AmBnZRF2QWf/";
        $this->send_pin_url = "{$this->gateway_url}gate/sendPin/AmBnZRF2QWf/{$this->keyword}/{$this->campaign_id}/";
        $this->check_pin_url = "{$this->gateway_url}gate/checkPin/AmBnZRF2QWf/{$this->keyword}/{$this->campaign_id}/";
        $this->load->model(array('smsender_model'));
    }

    /*
    ** Autorizar solicitud de envio
    */
    private function _authorizeRequest($nroMovil) {
        return $this->smsender_model->countMessagesToday($nroMovil) < $this->limite_mensajes_diarios;
    }
    
    /*
    ** Existencia de los datos del formulario
    */
    private function _existsData($namedata) {
        return $this->input->post($namedata);
    }
    
    /*
    ** Acciones a realizar si el usuario es nuevo
    */    
    private function _userNew($request_id, $data ){
    
        // Usuario no subscripto
        
        // Solicitar al gw envio de pin a numero origen
        $params = array(
            'nroPhone' => '34'.$data['origen_subno'],
        );
        $response = $this->curl->_simple_call('get', $this->send_pin_url, $params);

        // Quitar comentarios para forzar rstas del gateway para pruebas
        // $response = '{"rsp":"ok"}'; //-- PIN enviado
        // $response = '{"rsp":"error"}'; //-- Error en envio
        // $response = FALSE; //-- Error en comunicacion con gw
        
        // Actualizo DB
        $sendpin_request_row = array(
            'request_id' => $request_id,
            'send_pin_response' => $response
        );
        $this->smsender_model->saveSendPinRequest($sendpin_request_row);
        
        if ($response != FALSE){
            $response = json_decode($response);                
            if ($response->rsp == 'ok') {
                $this->session->set_userdata('last_sendpin', $request_id);
                redirect("/smsender/checkPin/$request_id");    
            } 
            else {
                $this->data['error'] = 'Debes indicar correctamente tu tel&eacute;fono m&oacute;vil, corrigelo e intenta de nuevo.';
            }
        } else {
            $this->data['error'] = 'Se produjo un error al intentar comunicacion con gateway';
        }
    
    }

    /*
    ** Acciones a realizar si quiere acceder un usuario registrado
    */
    private function _userRegister($request_id, $data) {
    
        // Chequeo de subscripción
        $paramscheck = array(
            'nroPhone' => '34'.$data['origen_subno'],
            'passwd' => $data['password'],
        );
        $responsecheck = $this->curl->_simple_call('get', $this->check_user_url, $paramscheck);
        
        // Quitar comentarios para forzar rstas del gateway para pruebas
        // $responsecheck = '{"rsp":"ok"}'; //-- Existe el usuario
        // $responsecheck = '{"rsp":"error"}'; //-- Error 
        // $responsecheck = FALSE; //-- Error en comunicacion con gw
        
        $checkuser_request_row = array(
            'request_id' => $request_id,
            'check_user_response' => $responsecheck
        );
        $this->smsender_model->saveCheckUserRequest($checkuser_request_row);
        
        if ($responsecheck != FALSE){
            $responsecheck = json_decode($responsecheck);                
            if ($responsecheck->rsp == 'ok') {
                if ($this->_authorizeRequest($data['origen_subno'])) {
                    // Usuario subscripto. Mando mensaje.
                    redirect("/smsender/sendmessageregister/$request_id");
                } else {
                    $this->data['error'] = "Ha alcanzado su limite diario de {$this->limite_mensajes_diarios} mensajes";
                }
            } else {
                $this->data['error'] = 'Usuario no encontrado.';
            }
        } else {
            $this->data['error'] = 'Se produjo un error al intentar comunicacion con gateway';
        }
    }
    
    /*
    ** Controlador principal
    */
	public function index() {
        // $this->output->enable_profiler(TRUE);

        // Procesamiento de datos de formulario
        if ( $this->_existsData('datanuevo') ) {

            $data = $this->input->post('datanuevo');
            
            $request_row = array(
                'origen_subno' => $data['origen_subno'],
                'destino_subno' => $data['destino_subno'],
                'message' => $data['message'],
            );
            $request_id = $this->smsender_model->saveRequest($request_row);
            
            if ($this->_authorizeRequest($data['origen_subno'])) {
                
                $this->session->set_userdata('last_request', $request_id);
                
                $this->_userNew($request_id, $data);             
                                 
            } else {
                // Request no autorizado
                $this->data['error'] = "Ha alcanzado su limite diario de {$this->limite_mensajes_diarios} mensajes";
            }
            
        } else {
        
            if ($this->_existsData('dataregistrado')) {

                // Es usuario registrado
                $dataregistrado = $this->input->post('dataregistrado');
                
                $request_row = array(
                    'origen_subno' => $dataregistrado['origen_subno'],
                    'password' => $dataregistrado['password'],
                );
                $request_id = $this->smsender_model->saveRequest($request_row);

                if ($this->_authorizeRequest($dataregistrado['origen_subno'])) {
                    
                    $this->session->set_userdata('last_request', $request_id);
                    
                    $this->_userRegister($request_id, $dataregistrado);
                                      
                } else {
                    // Request no autorizado
                    $this->dataregistrado['error'] = "Ha alcanzado su limite diario de {$this->limite_mensajes_diarios} mensajes";
                }
                
            } else {
                // Controlador accedido por GET
            
                // Verificar si hay mensajes en sesion
                if ($this->session->userdata('sendmessage_error')) {
                    $this->data["error"] = $this->session->userdata('sendmessage_error');
                    $this->session->unset_userdata('sendmessage_error');
                }
                if ($this->session->userdata('sendmessage_ok')) {
                    $this->data["status_message"] = $this->session->userdata('sendmessage_ok');
                    $this->session->unset_userdata('sendmessage_ok');
                }
            }
        }
        $this->data['content'] = $this->load->view('SMSender/smsender', $this->data, TRUE);
        $this->load->view($this->template, $this->data);
	}

    /*
    ** Chequeo de PIN
    */
    public function checkPin($id) {
        // Permitir acceso a validar solo el ultimo pin enviado
        $last_request = $this->session->userdata('last_request');
        $last_sendpin = $this->session->userdata('last_sendpin');
        if ($this->input->post('cancel') || $id != $last_request || $last_sendpin != $last_request) {
            redirect("/smsender/index");   
        }

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
                'nroPhone' => '34'.$request[0]->origen_subno,
                'pin' => $data['pin_insert'],
            );
            $response = $this->curl->_simple_call('get', $this->check_pin_url, $params);
                       
            // Quitar comentarios para forzar rstas del gateway para pruebas
            // $response = '{"rsp":"ok"}'; //-- PIN check ok
            // $response = '{"rsp":"error"}'; //-- PIN check not ok
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
                    if ($this->_authorizeRequest($request[0]->origen_subno)) {
                        // Mandar mensaje
                        $this->session->unset_userdata('last_sendpin');
                        redirect("/smsender/sendMessage/$id"); 
                    } else {
                        $this->data['error'] = "Ha alcanzado su limite diario de {$this->limite_mensajes_diarios} mensajes";
                    }
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
    
    
    /*
    ** Envio de mensaje usuario nuevo
    */
    public function sendMessage($id) {
         
        // Permitir acceso a enviar mensaje solo al ultimo request
        $last_request = $this->session->userdata('last_request');
        if ($id != $last_request) {
            redirect("/smsender/index");   
        }

         $params = array(
            'id' => $id
         );
         $request = $this->smsender_model->loadRequest($params);
         $this->datanuevo['request'] = $request[0];
                 
        
         // Variables para envio del mensaje
         $params = array(                
            'usr' => $this->usr,
            'pwd' => $this->pwd,
            'app' => $this->app,
            'sNumber' => $this->sNumber,
            'tNumber' => $request[0]->destino_subno,
            'mBody' => $request[0]->message,
         );
         $response = $this->curl->_simple_call('post', $this->send_message_url, $params);
                        
         // Quitar comentarios para forzar rstas del gateway para pruebas
         // $response = '200';    //-- mensaje enviado
         // $response = '400'; //-- Error 
 
         // Salvar sendmessage request
         $sendmessage_request_row = array(
            'request_id' => $id,
            'send_message_response' => $response
        );
        $this->smsender_model->saveSendMessageRequest($sendmessage_request_row);
                        
        if ($response == '200') {
            // Envio correcto del  mensaje
            $this->session->set_userdata ('sendmessage_ok', 'Mensaje enviado correctamente');
            $this->session->unset_userdata('last_request');
              
        } else {
            $this->session->set_userdata ('sendmessage_error', 'Error en el envio del mensaje');
        }
        redirect("/smsender/index"); 
    }
    
    /*
    ** Envio de mensaje para usuarios registrados
    */
    public function sendMessageRegister($id) {
        
        // Permitir acceso a enviar mensaje solo al ultimo request
        $last_request = $this->session->userdata('last_request');
        if ($this->input->post('cancel') || $id != $last_request) {
            redirect("/smsender/index");   
        }
        
        if ($this->_existsData('dataregistrado')){
            
            $dataregistrado = $this->input->post('dataregistrado');
            
            $params = array(
                'destino_subno' => $dataregistrado['destino_subno'],
                'message' => $dataregistrado['message']
            );
            $request = $this->smsender_model->updateRequest($id,$params);
                                  
           
            // Variables para envio del mensaje
            $params = array(
                'usr' => $this->usr,
                'pwd' => $this->pwd,
                'app' => $this->app,
                'sNumber' => $this->sNumber,
                'tNumber' => $dataregistrado['destino_subno'],
                'mBody' => $dataregistrado['message'],
            );
            $response = $this->curl->_simple_call('post', $this->send_message_url, $params);
                
                           
            // Quitar comentarios para forzar rstas del gateway para pruebas
            // $response = '200'; //-- mensaje enviado
            // $response = '400'; //-- Error 

            // Salvar sendmessage request            
            $sendmessage_request_row = array(
                'request_id' => $id,
                'send_message_response' => $response
            );
            $this->smsender_model->saveSendMessageRequest($sendmessage_request_row);
                            
            if ($response == '200') {
                // Envio correcto del  mensaje
                $this->session->set_userdata ('sendmessage_ok', 'Mensaje enviado correctamente');
                $this->session->unset_userdata('last_request');
                  
            } else {
                $this->session->set_userdata ('sendmessage_error', 'Error en el envio del mensaje');
            }
            redirect("/smsender/index"); 
        }

        $params = array(
            'id' => $id
        );
        $request = $this->smsender_model->loadRequest($params);
        $this->data['request'] = $request[0];

        $this->data['content'] = $this->load->view('SMSender/registrados', $this->data, TRUE);
        $this->load->view($this->template, $this->data);
        
    }
}

?>

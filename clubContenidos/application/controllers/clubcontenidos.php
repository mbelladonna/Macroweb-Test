<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class clubcontenidos extends MY_Controller {

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
    var $keyword = 'clubcontenidos';

    // Parametros para comunicacion con api eg-telecom
    var $send_message_url = 'http://api.sms.egtelecom.es/pass/send.php';
    var $usr = 'querox s.l';
    var $pwd = 'sgB71SDf20';
    var $app = 'PUSH-ECO';
    var $sNumber = '';

    
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
        $this->load->model(array('clubcontenidos_model'));
    }

        
    /*
    ** Controlador principal
    */
	public function index() {
         //$this->output->enable_profiler(TRUE);
        $this->data['title'] = 'Club Contenidos';
        $this->data['content'] = $this->load->view('clubcontenidos/clubcontenidos', $this->data, TRUE);
        $this->load->view($this->template, $this->data);
	}
    
    public function login(){
    
        if ($this->input->post('data')) {
            $data = $this->input->post('data');
           
            if ($this->simplelogin->login($data['movil'], $data['password'],$this->check_user_url, $this->clubcontenidos_model)) {
                    $this->data['error'] = "Nombre de usuario y/o password válidos";
                    redirect("/clubcontenidos");
                    
            } else {
                $this->data['error'] = "ERROR: Nombre de usuario y/o password inválidos";
            }
                        
            
        }
        $this->data['title'] = 'Club Contenidos - Login';
        $this->data['content'] = $this->load->view('clubcontenidos/login', $this->data, TRUE);
        $this->load->view($this->template, $this->data);
    }
    
    public function logout() {
        $this->simplelogin->logout();
        redirect("/clubcontenidos");
    }

     public function register(){
        if ( $this->input->post('data') ) {
        
            $data = $this->input->post('data');
        
            $request_row = array(
                'movil' => $data['movil'],
            );
            $request_id = $this->clubcontenidos_model->saveRequest($request_row);
            
                      
            // Usuario no subscripto
        
            // Solicitar al gw envio de pin a numero origen
            $params = array(
                'nroPhone' => '34'.$data['movil'],
            );
            //$response = $this->curl->_simple_call('get', $this->send_pin_url, $params);

            // Quitar comentarios para forzar rstas del gateway para pruebas
             $response = '{"rsp":"ok"}'; //-- PIN enviado
            // $response = '{"rsp":"error"}'; //-- Error en envio
            // $response = FALSE; //-- Error en comunicacion con gw
            
            // Actualizo DB
            $sendpin_request_row = array(
                'request_id' => $request_id,
                'send_pin_response' => $response
            );
            $this->clubcontenidos_model->saveSendPinRequest($sendpin_request_row);
            
            if ($response != FALSE){
                $response = json_decode($response);                
                if ($response->rsp == 'ok') {
                   
                    redirect("/clubcontenidos/checkPin/$request_id");    
                } 
                else {
                    $this->data['error'] = 'Debes indicar correctamente tu tel&eacute;fono m&oacute;vil, corrigelo e intenta de nuevo.';
                }
            } else {
                $this->data['error'] = 'Se produjo un error al intentar comunicacion con gateway';
            }
        }                
        
        
        $this->data['title'] = 'Club Contenidos - Register';
        $this->data['content'] = $this->load->view('clubcontenidos/register', $this->data, TRUE);
        $this->load->view($this->template, $this->data);
    }

    /*
    ** Chequeo de PIN
    */
    public function checkPin($id) {
        
        $params = array(
            'id' => $id
        );
        $request = $this->clubcontenidos_model->loadRequest($params);
        $this->data['request'] = $request[0];
       
        // Obtengo  datos del formulario
        if ($this->input->post('data')){

            $data = $this->input->post('data');
            
            // Variables para chequeo de pin
            $params = array(
                'nroPhone' => '34'.$request[0]->movil,
                'pin' => $data['pin'],
            );
            //$response = $this->curl->_simple_call('get', $this->check_pin_url, $params);
                       
            // Quitar comentarios para forzar rstas del gateway para pruebas
             $response = '{"rsp":"ok"}'; //-- PIN check ok
            // $response = '{"rsp":"error"}'; //-- PIN check not ok
            // $response = FALSE; //-- Error en comunicacion con gw

            // Salvar en la base de datos            
            $checkpin_request_row = array(
                'request_id' => $id,
                'pin' => $data['pin'],
                'check_pin_response' => $response
            );
            $this->clubcontenidos_model->saveCheckpinRequest($checkpin_request_row);
            
            if ($response != FALSE){
                $response = json_decode($response);                
                if ($response->rsp == 'ok') {
                    
                    $this->data['error'] =  'Ingreso correctamente el pin enviado';
                    redirect('clubcontenidos/');  
                                      
                   
                } else {
                    $this->data['error'] = 'Error al chequear el pin';
                }
            } else {
                $this->data['error'] = 'Error en comunicación con gateway';
            }

        }
        $this->data['title'] = 'Club Contenidos - Check Pin';
        $this->data['content'] = $this->load->view('clubcontenidos/checkpin', $this->data, TRUE);
        $this->load->view($this->template, $this->data);        
    }
    
    /*
    ** Acciones a realizar si el usuario es nuevo
    */    
    public function newUser(){
    
        
    $this->data['title'] = 'Club Contenidos - Registro usuario nuevo';
    $this->data['content'] = $this->load->view('clubcontenidos/newuser', $this->data, TRUE);
    $this->load->view($this->template, $this->data); 
    }
}
    
 
?>

<?php

class Pornoxmovil extends CI_Controller {

	/* 
    ** Variables de configuracion
    */
    var $template = 'base';
	
	// Parametros para comunicacion con gateway-pupolis
    var $gateway_url = '';
	var $auth_subsc_url='';
    var $success_url = 'pornoxmovil/subscription_ok';
	var $error_url = 'pornoxmovil/subscription_Error';
    var $notify_url = 'pornoxmovil/payment_notify';
	var $gateway_key='AmBnZRF2QWf';
    

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
		//http://localhost/Gateway-Pupolis/index.php/obapi/authPaymentSubscription?gatewayKey=AmBnZRF2QWf&carrier=movistar-es&channel=web&maximum_per_period=5&amount_per_transaction=1&currency=EUR&period=weekly&user=154078200&description=test&long_description=long%20Test&adult=true&userdata=1&success_url=http://myurl.com&error_url=http://myerrorurl.com&notify_url=http://mynotifyurl.com
		$this->auth_subsc_url = "{$this->gateway_url}/obapi/authPaymentSubscription?{$this->gateway_key}";
        
    }

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
	
	
	public function authorizeSubsc() {
        
		// parametros metodo  
		
		//----------------datos de ejemplo--------------
        $params = array(
            "carrier" => 'movistar-es',
            "channel" => 'web',
            "maximum_per_period" => '5',
            "amount_per_transaction" => '1',
            "currency" => 'EUR',
            "period" => 'weekly',
            "user" => '154078200',
            "description" => 'test',
            "long_description" => 'long%20Test',
            "adult" => 'true' ,
            "userdata" => '1',
            "success_url" => $this->success_url ,
            "error_url" => $this->error_url,
            "notify_url" => $this->notify_url
        );
				
		// modelo
        
		
		
		// envio request a API
		//$response = $this->curl->_simple_call('get', $this->auth_subsc_url, $params);
                       
		// Quitar comentarios para forzar rstas del gateway para pruebas
		 $response = '{"success":true,"action":"redirect","url":"pornoxmovil/subscription_ok","transaction_id":"2e12aa7d534d5555abf4aa3bb45048334e30334559bbd544230850"}'; 
		// $response = '{"rsp":"error"}'; //-- PIN check not ok
		// $response = FALSE; //-- Error en comunicacion con gw

        // Salvar en la base de datos            
        if ($response != FALSE){
                $response = json_decode($response);                
                if (($response->success ==true) &&($response->action == 'redirect')) {
				
						// si es correcto deberia redireccionar a contenido
                        redirect($response->url); 
                     
                } else {
                    //error
                }
            } else {
                //error
            }

        }
        $this->data['content'] = $this->load->view('pornoxmovil/subscription_error', $this->data, TRUE);
        $this->load->view($this->template, $this->data);        
    }
	
	/*public function subscript_ok(){
	
		$this->data['content'] = $this->load->view("pornoxmovil/subscription_ok", $this->data, TRUE);
        $this->load->view($this->template, $this->data);
	
	}
	
	public function subscript_error(){
	
		$this->data['content'] = $this->load->view("pornoxmovil/subscription_error", $this->data, TRUE);
        $this->load->view($this->template, $this->data);
	
	}
	*/
	
    
    
}

?>

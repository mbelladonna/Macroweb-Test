<?php

class pornoxmovil extends MY_Controller {

	/* 
    ** Variables de configuracion
    */
    var $template = 'base';
	
	// Parametros para comunicacion con gateway-pupolis
    var $gateway_url = '';
	var $auth_sub_url='';
	var $payment_check_url='';
    var $notify_url = '';
	var $gateway_key='AmBnZRF2QWf';

    // Scripts de procesamiento de rsta de pornoxmovil
    var $success_url = 'subscriptionOk';
	var $error_url = 'subscriptionError';
    
    // Parametros para suscripcion
    var $subscription_params;

    function __construct() {
        parent::__construct();
        $this->debug = false;
        if (SITE_URL == 'local') {
            $this->gateway_url = 'http://localhost/Gateway-Pupolis/index.php/';
        } elseif (SITE_URL == 'production') {
            $this->gateway_url = 'http://gate.pupolis.com/';
        } else {
            die("Error. SITE_URL invalido.");
        }
		$this->auth_sub_url = "{$this->gateway_url}obapi/authPaymentSubscription";
		$this->payment_check_url = "{$this->gateway_url}obapi/paymentCheck";
        $this->success_url = base_url().$this->success_url;
        $this->error_url = base_url().$this->error_url;
        $this->notify_url = "{$this->gateway_url}obapi/notificationServer";
        $this->subscription_params = array(
            "gatewayKey" => $this->gateway_key,
            "carrier" => 'movistar-es',
            "channel" => 'web',
            "maximum_per_period" => '5',
            "amount_per_transaction" => '5',
            "currency" => 'EUR',
            "period" => 'weekly',
            "user" => '',
            "description" => 'Probando pornoxmovil.com',
            "long_description" => 'Esta es una prueba de la suscripcion desde pornoxmovil.com',
            "adult" => 'true' ,
            "userdata" => 'pornoxmovil.com',
            "success_url" => $this->success_url ,
            "error_url" => $this->error_url,
            "notify_url" => $this->notify_url
        );
		$this->load->model(array('pornoxmovil_model'));
    }

    private function _validPage($pagina) {
        return $pagina == 1 || $pagina == 2 || $pagina == 3;
    }

	public function index()	{
		$pagina = $this->input->get('page');
        $pagina = $this->_validPage($pagina) ? $pagina : 1;
        
        $this->data['pagina'] = $pagina;
        $this->data['video_url'] = base_url().'index.php/pornoxmovil/ver_video/';
		$this->data['page_title'] = 'Pornoxmovil.com';
        $this->data['sub_title'] = 'Últimos Videos';
		$this->data['content'] = $this->load->view("pornoxmovil/pornoxmovil_".$pagina, $this->data, TRUE);
        $this->data['paginador'] = $this->load->view("pornoxmovil/paginador", $this->data, TRUE);
        $this->load->view($this->template, $this->data);
	}
	
	public function authorizeSubscription() {
        if ($this->input->post('data')) {
            $data = $this->input->post('data');
            $params = $this->subscription_params;
            $params['user'] = $data['movil'];
				
		    // Envio request a API
		   //$response = $this->curl->_simple_call('get', $this->auth_sub_url, $params);
            
            // Quitar comentarios para forzar rstas del gateway para pruebas
            // Response ok
		     $response = '{"id":0,"error":null,"result":{"success":true,"action":"redirect","url":"http:\/\/compra.pagos.movistar.es\/PurchaseApp\/MMACustomerArrived.do;jsessionid=SbVmTwzFpY7QH4f66KxZGzMyS8Rdpp148kpL8kpJhBP4qTY8S6BB!-1951730233!1311781701884?wispSessionID=193978068417","transaction_id":"2e12aa7d534d21beabf4aa3bb45048334e30334559bbd544230852"}}';
            // Response error
            // $response = '{"success":false,"error":{"code":1008,"reason":"method-not-supported-by-carrier","http":"bad-request","url":null,"description":null},"id":0}';
            $this->printPreDebug('Rsta de gateway', $response);

            if ($response != FALSE) {
                $response = json_decode($response);
                $this->printPreDebug('Rsta de gateway parseada a objeto', $response);
                if ( ($response->error == NULL) && ($response->result->action == 'redirect') ) {
                    $this->pornoxmovil_model->saveTransactionsIdRequest(array('transaction_id' => $response->result->transaction_id));
				    redirect($response->result->url); 
                } else {
                    $this->data['error'] = 'Error al intentar autorizar suscripción.';
                }
            } else {
                $this->data['error'] = "Error en comunicación con gateway : ({$this->curl->error_code} - {$this->curl->error_string})";
            }
        }

        $this->data['page_title'] = 'Pornoxmovil.com - Autorizar Suscripción';
        $this->data['sub_title'] = 'Nueva Suscripción';
		$this->data['content'] = $this->load->view("pornoxmovil/authSubscription", $this->data, TRUE);
        $this->data['paginador'] = '';
        $this->load->view($this->template, $this->data);
    }
	
	public function subscriptionOk() {
        $transaction_id = $this->input->get('__transaction_id');
        $channel = $this->input->get('__channel');
        
        if ($this->pornoxmovil_model->transactionIdValid($transaction_id)) {
			$params = array (
                "gatewayKey" => $this->gateway_key,
				"transaction_id" => $transaction_id
			);
			
            // Envio request a API
			//$response = $this->curl->_simple_call('get', $this->payment_check_url, $params);
            
            // Quitar comentarios para forzar rstas del gateway para pruebas
            // Response ok
             $response = '{ "id":0, "error":null, "result": { "carrier":"movistar-es" , "amount":15, "currency": 1, "user": 100,"userdata":"userdata","date":"14-09-2011", "transaction_id":"2e12aa7d534d21beabf4aa3bb45048334e30334559bbd544230852", "subscription" : { "id":12,"start_date":"01-09-2011", "expires_date": "25-09-2011", "period": "weekly"}, "completed": 1 } }';
            // Response error
            // $response = '{"success":false,"error":{"code":1008,"reason":"method-not-supported-by-carrier","http":"bad-request","url":null,"description":null},"id":0}';
            $this->printPreDebug('Rsta de gateway', $response);
					
			if ($response != FALSE) {
                $response = json_decode($response);
                $this->printPreDebug('Rsta de gateway parseada a objeto', $response);
                if ( ($response->error == NULL) ) {
                    if ( $response->result->completed == 1 ) {
                        $this->session->set_userdata('transaction_id', $transaction_id);
				        redirect("/pornoxmovil/register");
                    } else {
                        $this->data['error'] = 'El gateway informa que la suscripción no se ha completado.';
                    }
                } else {
                    $this->data['error'] = 'Error al intentar recuperar información de suscripción.';
                }
            } else {
                $this->data['error'] = "Error en comunicación con gateway : ({$this->curl->error_code} - {$this->curl->error_string})";
            }
		} else {
			 $this->data['error'] = "Identificador de transacción inválido o usado. No se pudo completar el registro";
		}

        $this->data['page_title'] = 'Pornoxmovil.com - Suscripción';
        $this->data['sub_title'] = 'Resultado de Suscripción';
        $this->data['content'] = $this->load->view("pornoxmovil/subscriptionOk", $this->data, TRUE);
        $this->data['paginador'] = '';
        $this->load->view($this->template, $this->data);
	}
	
	public function subscriptionError() {
        $this->data['error'] = 'Error en suscripción';
		$this->data['page_title'] = 'Pornoxmovil.com - Suscripción';
        $this->data['sub_title'] = 'Resultado de Suscripción';
        $this->data['content'] = $this->load->view("pornoxmovil/subscriptionError", $this->data, TRUE);
        $this->data['paginador'] = '';
        $this->load->view($this->template, $this->data);
	}
	
	public function ver_video($nrovideo) {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_userdata('selected_video', $nrovideo);
            redirect("/pornoxmovil/login");
        }

        if (!isset($nrovideo)) {
            if (!$this->session->userdata('selected_video')) {
                redirect("/pornoxmovil"); 
            } else {
                $nrovideo = $this->session->userdata('selected_video');
                $this->session->unset_userdata('selected_video');
            }
        }
        
		$this->data['nro_video']= $nrovideo;
        $this->data['page_title'] = 'Pornoxmovil.com - Ver Video';
        $this->data['sub_title'] = 'Ver Video';
		$this->data['content'] = $this->load->view('pornoxmovil/vervideo', $this->data, TRUE);
        $this->data['paginador'] = '';
        $this->load->view($this->template, $this->data);
    }	

    public function login() {
        if ($this->input->post('data')) {
            $data = $this->input->post('data');
            $selected_video = $this->session->userdata('selected_video');
            if ($this->simplelogin->login($data['username'], $data['password'])) {
                redirect("/pornoxmovil/ver_video/$selected_video");
            } else {
                $this->data['error'] = "Nombre de usuario y/o password inválidos";
            }
        }
        $this->data['page_title'] = 'Pornoxmovil.com - Login';
        $this->data['sub_title'] = 'Login';
		$this->data['content'] = $this->load->view("pornoxmovil/login", $this->data, TRUE);
        $this->data['paginador'] = '';
        $this->load->view($this->template, $this->data);
    }

    public function logout() {
        $this->simplelogin->logout();
        redirect("/pornoxmovil");
    }
	
    public function register() {
        if ($this->session->userdata('transaction_id')) {
            $transaction_id = $this->session->userdata('transaction_id');
        } else {
            redirect("pornoxmovil/index");
        }
        
	    if ($this->input->post('data')) {
		    $data = $this->input->post('data');
		    if ($this->simplelogin->create($data['username'], $data['password'], true)) {
                $this->pornoxmovil_model->useTransactionId($transaction_id);
                $this->session->unset_userdata('transaction_id');
			    redirect("pornoxmovil/index");
		    } else {
			    $this->data['error'] = "Nombre de usuario y/o password inválidos";
		    }
	    }
			
	    $this->data['page_title'] = 'Pornoxmovil.com - Register';
	    $this->data['sub_title'] = 'Registrate';
	    $this->data['content'] = $this->load->view("pornoxmovil/register", $this->data, TRUE);
	    $this->data['paginador'] = '';
	    $this->load->view($this->template, $this->data);	
	}
	
}

?>

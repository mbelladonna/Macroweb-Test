<?php


class pornoxmovil extends CI_Controller {

	/* 
    ** Variables de configuracion
    */
    var $template = 'base';
	
	// Parametros para comunicacion con gateway-pupolis
    var $gateway_url = '';
	var $auth_subsc_url='';
	var $payment_check_url='';
    var $success_url = 'pornoxmovil/subscription_ok';
	var $error_url = 'pornoxmovil/subscription_error';
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
        if (SITE_URL == 'local') {
            $this->gateway_url = 'http://localhost/Gateway-Pupolis/index.php/';
        } elseif (SITE_URL == 'production') {
            $this->gateway_url = 'http://gate.pupolis.com/';
        } else {
            die("Error. SITE_URL invalido.");
        }
		$this->auth_subsc_url = "{$this->gateway_url}/obapi/authPaymentSubscription?gatewayKey={$this->gateway_key}";
		$this->payment_check_url = "{$this->gateway_url}/obapi/paymentCheck?gatewayKey={$this->gateway_key}";
		
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
	
	public function authorizeSubsc() {
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
				
		// envio request a API
		// $response = $this->curl->_simple_call('get', $this->auth_subsc_url, $params);
                       
		// Quitar comentarios para forzar rstas del gateway para pruebas
		$response = '{"success":true,"action":"redirect","url":"pornoxmovil/subscription_ok","transaction_id":"2e12aa7d534d5555abf4aa3bb45048334e30334559bbd544230850"}'; 
		
        // Salvar en la base de datos

		
        if ($response != FALSE) {
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
	
	
	// para probar la funcion pasar transaction_id x parametro y previamente crear en la DB un registro donde el bit usado sea 0
	public function register($transaction_id='') {
	

		if ($transaction_id!='') {
			
			if ($this->pornoxmovil_model->transactionIdValid($transaction_id)){
								
				$params = array(
						"transaction_id" => $transaction_id
				);
				
				//$response_id = $this->curl->_simple_call('get', $this->payment_check_url, $params);
                 
				/* estructura respuesta
					result: carrier, amount, currency, user, userdata,date,transaction_id, 
							subscription : idstart_date,expires_date,period
							completed,reason
				*/
				$response_id = '{ "result": { "carrier":"movistar-es" , "amount":15, "currency": 1, "user": 100,"userdata":"userdata","date":"14-09-2011", "transaction_id":1111, "subscription" : { "id":12,"start_date":"01-09-2011", "expires_date": "25-09-2011", "period": "weekly"}, "completed":true, "reason":null}'; 
						
				//ver bien si el nro user es el numero de telefono si no se debe guardar en la base de datos
				
				/*if ($response_id != FALSE) {
					$response_id = json_decode($response_id);                
					if ($response_id->   ) {
						
						redirect(  ); 
					 
					} else {
						//error
					}
				} else {
					//error
				}*/
				
				if ($this->input->post('data')) {
					$data = $this->input->post('data');
					if ($this->simplelogin->create($data['username'], $data['password'], true)){
						// usuario creado y logeado correctamente
						redirect("pornoxmovil/index");
					}
					else {
							// error al registrar usuario
						 $this->data['error'] = "Nombre de usuario y/o password inválidos";
					}
				}
				
				$this->data['page_title'] = 'Pornoxmovil.com - Register';
				$this->data['sub_title'] = 'Registrate';
				$this->data['content'] = $this->load->view("pornoxmovil/register", $this->data, TRUE);
				$this->data['paginador'] = '';
				$this->load->view($this->template, $this->data);
					
				
				}
				else {
					 $this->data['error'] = "Transaction id invalido o usado.";
				}
				
			}
		else {
			echo "Error - Se necesita ingresar un transactionId ( localhost/pornoxmovil/index.php/pornoxmovil/register/1111)";
		}
		
	}
	
}

?>

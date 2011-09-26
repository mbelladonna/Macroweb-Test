<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Simplelogin Class
 *
 * Makes authentication simple
 *
 * Simplelogin is released to the public domain
 * (use it however you want to)
 * 
 * Simplelogin expects this database setup
 * (if you are not using this setup you may
 * need to do some tweaking)
 * 

	#This is for a MySQL table
	CREATE TABLE `users` (
	`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`username` VARCHAR( 64 ) NOT NULL ,
	`password` VARCHAR( 64 ) NOT NULL ,
	UNIQUE (
	`username`
	)
	);

 * 
 */
class Simplelogin
{
	var $CI;
	var $user_table = 'users';

	function Simplelogin()
	{
		// get_instance does not work well in PHP 4
		// you end up with two instances
		// of the CI object and missing data
		// when you call get_instance in the constructor
		//$this->CI =& get_instance();
	}

		


	/**
	 * Login and sets session variables
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function login($user = '', $password = '', $check_user_url='') {
		//Put here for PHP 4 users
		$this->CI =& get_instance();		

		//Make sure login info was sent
		if($user == '' OR $password == '' OR $check_user_url == '') {
			return false;
		}

		//Check if already logged in
		if($this->CI->session->userdata('username') == $user) {
			//User is already logged in.
			return false;
		}
        
        // Chequeo de subscripción
        $paramscheck = array(
            'nroPhone' => '34'.$user,
            'passwd' => $password,
        );
       // $responsecheck = $this->curl->_simple_call('get', $check_user_url, $paramscheck);
        
        // Quitar comentarios para forzar rstas del gateway para pruebas
         $responsecheck = '{"rsp":"ok"}'; //-- Existe el usuario
        // $responsecheck = '{"rsp":"error"}'; //-- Error 
        // $responsecheck = FALSE; //-- Error en comunicacion con gw
        
        /*$checkuser_request_row = array(
            'request_id' => $request_id,
            'check_user_response' => $responsecheck
        );
        $this->smsender_model->saveCheckUserRequest($checkuser_request_row);
        */
        
        if ($responsecheck != FALSE){
            $responsecheck = json_decode($responsecheck);                
            if ($responsecheck->rsp == 'ok') {
            
                //Destroy old session
                $this->CI->session->sess_destroy();
                
                //Create a fresh, brand new session
                $this->CI->session->sess_create();
                
                $row = array(
						'username' => $user,
					);
                                
                //Set session data
                $this->CI->session->set_userdata($row);
                
                //Set logged_in to true
                $this->CI->session->set_userdata(array('logged_in' => true));			
                
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
	}

	/**
	 * Logout user
	 *
	 * @access	public
	 * @return	void
	 */
	function logout() {
		//Put here for PHP 4 users
		$this->CI =& get_instance();		

		//Destroy session
		$this->CI->session->sess_destroy();
	}
}
?>

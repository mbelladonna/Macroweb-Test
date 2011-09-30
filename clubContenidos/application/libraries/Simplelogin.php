<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Simplelogin Class
 *
 * Makes authentication simple
 *
 
 * 
 */
class Simplelogin
{
	var $CI;
	

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
	function login($user = '') {
		//Put here for PHP 4 users
		$this->CI =& get_instance();		

		//Make sure login info was sent
		if($user == '') {
			return false;
		}

		//Check if already logged in
		if($this->CI->session->userdata('username') == $user) {
			//User is already logged in.
			return false;
		}
        
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
        
	}
    
    function userLogged(){
        return $this->CI->session->userdata('username');
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

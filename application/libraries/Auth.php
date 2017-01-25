<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {

	private $ci;

	public function __construct() {

		$this->ci =& get_instance();
	}

	public function login($key, $password) {

		$user = $this->check($key, $password);

		if($user) {
			unset($user->password);
			$this->ci->session->set_userdata('user', $user);
		}

		return $user;
	}

	public function login_by_id($id) {

		$user = $this->ci->User->get($id);

		if($user) {
			unset($user->password);
			$this->ci->session->set_userdata('user', $user);
		}

		return $user;
	}

	public function logout() {

		$this->ci->session->unset_userdata('user');
	}

	public function is_logged_in() {

		$user = $this->ci->session->userdata('user');

		if($user) {

			$user = $this->ci->User->get($user->id);
			
			if($user) {
				return TRUE;
			}
		}

		$this->logout();
		return FALSE;
	}

	public function get_current_user($refresh = FALSE) {

		if($this->is_logged_in()) {

			if($refresh) {

				$user = $this->ci->session->userdata('user');
				$user = $this->ci->User->get($user->id);
				
				unset($user->password);
				$this->ci->session->set_userdata('user', $user);

				return $user;
			}

			$user = $this->ci->session->userdata('user');
			return $user;
		}

		return NULL;
	}

	public function check($key, $password) {

		$user = $this->ci->User->get_by_key('email', $key);

		if($user) {
			if(password_verify($password, $user->password)) {
				return $user;
			}
		}

		return NULL;
	}

}

/* End of file Auth.php */
/* Location: ./application/libraries/Auth.php */
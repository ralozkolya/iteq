<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_admin extends MY_Model {

	protected $table = 'admins';

	public function add($raw) {

		$data['username'] = $raw['username'];
		$data['password'] = $this->hash_password($raw['password']);

		return parent::add($data);
	}

	public function edit_password($user, $password) {

		$data['id'] = $user;
		$data['password'] = $this->hash_password($password);

		return parent::edit($data);
	}

	private function hash_password($password) {

		return password_hash($password, PASSWORD_DEFAULT, array('cost' => 12));
	}

}

/* End of file User_admin.php */
/* Location: ./application/models/User_admin.php */
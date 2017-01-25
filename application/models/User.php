<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Model {

	protected $table = 'users';

	public function add($raw) {

		$data['first_name'] = $raw['first_name'];
		$data['last_name'] = $raw['last_name'];
		$data['personal_number'] = $raw['personal_number'];
		$data['email'] = $raw['email'];
		$data['phone'] = $raw['phone'];
		$data['password'] = $this->hash_password($raw['password']);

		return parent::add($data);
	}

	public function get_list_admin($page = 1) {

		if(is_numeric($page)) {
			$page = abs($page - 1);
		}

		else {
			$page = 0;
		}

		$offset = $page * ITEMS_PER_PAGE_ADMIN;

		$users = parent::get_list(ITEMS_PER_PAGE_ADMIN, $offset);

		$total_rows = $this->db->get($this->table)->num_rows();

		$result = array(
			'users' => $users,
			'total_rows' => $total_rows,
		);

		return $result;
	}

	public function change_password($user, $password) {

		return parent::edit(array(
			'id' => $user,
			'password' => $this->hash_password($password),
		));
	}

	public function get_token() {

		do {

			$token = bin2hex(openssl_random_pseudo_bytes(64));

			$r = parent::get_by_key('token', $token);

		} while($r);

		return $token;
	}

	private function hash_password($password) {

		return password_hash($password, PASSWORD_DEFAULT, array('cost' => 12));
	}

}

/* End of file User.php */
/* Location: ./application/models/User.php */
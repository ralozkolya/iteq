<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends MY_Model {

	protected $table = 'addresses';

	public function get_for_user($user) {

		$this->db->where('user', $user);

		return parent::get_list();
	}

}

/* End of file Address.php */
/* Location: ./application/models/Address.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Model {

	protected $table = 'orders';

	public function get_for_user($user) {

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			'*', $lang.'_description as description',
		));

		$this->db->where('user', $user); 

		$this->db->order_by('id DESC');

		return parent::get_list();
	}

	public function get_list_admin($page = 1) {

		if(is_numeric($page)) {
			$page = abs($page - 1);
		}

		else {
			$page = 0;
		}

		$offset = $page * ITEMS_PER_PAGE_ADMIN;

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			"orders.{$lang}_description as description",
			'orders.address', 'orders.modified', 'orders.status',
			'orders.amount', 'users.first_name', 'users.last_name', 'users.id',
		));

		$this->db->join('users', 'users.id = orders.user');

		$this->db->order_by('orders.id DESC');

		$orders = parent::get_list(ITEMS_PER_PAGE_ADMIN, $offset);

		$total_rows = $this->db->get($this->table)->num_rows();

		$result = array(
			'orders' => $orders,
			'total_rows' => $total_rows,
		);

		return $result;
	}

	public function update_recents() {

		$this->db->where('modified < DATE_SUB(NOW(), INTERVAL 1 DAY)');
		$this->db->where('status', PENDING);

		return $this->db->update($this->table, array(
			'status' => FAILED,
		));
	}

}

/* End of file Order.php */
/* Location: ./application/models/Order.php */
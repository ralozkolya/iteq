<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	protected $data = array(
		'title' => 'ITEQ.ge',
		'highlighted' => 'none',
	);

	public function __construct() {

		parent::__construct();

		set_language();

		$this->load->language(array('general'));

		$this->load->model(array('Page', 'Category', 'User'));
		$this->load->library('Auth');

		$this->data['navigation'] = $this->Page->get_navigation();
		$this->data['top_categories'] = $this->Category->get_top();

		$cart = $this->session->userdata('cart');

		if(is_null($cart)) {
			$cart = array();
		}

		$this->data['cart'] = $cart;

		$this->data['user'] = $this->auth->get_current_user();
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
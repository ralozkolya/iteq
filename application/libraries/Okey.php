<?php

use GuzzleHttp\Client;

class Okey {

	private $merchant;
	private $key;

	public function __construct($params = NULL) {
		$this->merchant = getenv('OKEY_MERCHANT_ID');
		$this->key = getenv('OKEY_API_KEY');
	}

	public function check($user, $address, $product) {

		$ci =& get_instance();

		$ci->load->model(['Product', 'User', 'Address']);

		$user = $ci->User->get($user);
		$address = $ci->Address->get($address);
		$product = $ci->Product->get($product);

		if(!$user || !$address || !$product) {
			$ci->session->set_flashdata('error_message', lang('unexpected_error'));
			redirect($ci->agent->referrer());
		}

		$client = new Client();

		echo $this->key;
	}
}
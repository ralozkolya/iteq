<?php

use GuzzleHttp\Client;

class Okey {

	private $merchant;
	private $key;
	private $url;

	public function __construct($params = NULL) {
		$this->merchant = getenv('OKEY_MERCHANT_ID');
		$this->key = getenv('OKEY_API_KEY');
		$this->url = getenv('OKEY_URL');
		$this->redirect_url = getenv('OKEY_REDIRECT_URL');
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

		$response = $client->post($this->url, [
			'json' => [
				'merchant' => $this->merchant,
				'testmode' => 0,
				'totalprice' => $product->price,
				'shippingPrice' => 0,
				'address' => $address->address,
				'city' => $address->city,
				'ordernumber' => bin2hex(openssl_random_pseudo_bytes(64)),
				'products' => [
					[
						'title' => $product->name,
						'price' => $product->price,
						'quantity' => 1,
					],
				],
			],
			'headers' => [
				'Authorization' => $this->key,
			],
		]);

		if($response->getStatusCode() === 200) {
			$res = json_decode($response->getBody()->getContents());
			redirect($this->redirect_url . $res->trans_id);
		}
	}
}
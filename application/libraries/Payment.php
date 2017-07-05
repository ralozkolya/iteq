<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Payment {

	private $client;

	private $cert_path;
	private $cert_key;

	private $merchant_url;

	public function __construct() {

		$this->cert_path = getenv('PAY_CERT_PATH');
		$this->cert_key = getenv('PAY_CERT_KEY');
		$this->merchant_url = getenv('PAY_URL');

		$this->client = new Client(array(
			'verify' => FALSE,
			'cert' => array(
				$this->cert_path, $this->cert_key,
			),
		));
	}

	public function get_transaction_id($amount, $ip, $description = '') {

		$response = $this->client->post($this->merchant_url, array(
			'form_params' => array(
				'command' => 'v',
				'amount' => $amount,
				'currency' => 981, //USD=840 GEL=981
				'client_ip_addr' => $ip,
				'description' => $description,
				'language' => get_lang_code(get_lang()),
				'msg_type' => 'SMS',
			),
		));

		if($response->getStatusCode() === 200) {

			$body = $response->getBody()->getContents();

			$parsed = $this->parse_result($body);

			if(empty($parsed['error']) && !empty($parsed['TRANSACTION_ID'])) {

				return $parsed['TRANSACTION_ID'];
			}
		}

		return NULL;
	}

	public function get_transaction_status($trans_id, $ip) {

		$response = $this->client->post($this->merchant_url, array(
			'form_params' => array(
				'command' => 'c',
				'trans_id' => $trans_id,
				'client_ip_addr' => $ip,
			),
		));

		if($response->getStatusCode() === 200) {

			$body = $response->getBody()->getContents();

			$parsed = $this->parse_result($body);

			if(empty($parsed['error'])) {

				return $parsed;
			}
		}

		return NULL;
	}

	public function close_day() {

		$response = $this->client->post($this->merchant_url, array(
			'form_params' => array(
				'command' => 'b',
			),
		));

		if($response->getStatusCode() === 200) {

			$body = $response->getBody()->getContents();

			$parsed = $this->parse_result($body);

			if(empty($parsed['error'])) {

				return $parsed;
			}
		}

		return NULL;
	}

	public function reverse($trans_id) {

		$response = $this->client->post($this->merchant_url, array(
			'form_params' => array(
				'command' => 'r',
				'trans_id' => $trans_id,
			),
		));

		if($response->getStatusCode() === 200) {

			$body = $response->getBody()->getContents();

			$parsed = $this->parse_result($body);

			if(empty($parsed['error'])) {

				return $parsed;
			}
		}

		return NULL;
	}

	private function parse_result($string) {
		$array1 = explode(PHP_EOL, trim($string));
		$result = array();
		foreach( $array1 as $key => $value )
		{
			$array2 = explode( ':', $value  );
			$result[ $array2[0] ] = trim( $array2[1] );
		}
		
		return $result;
	}
}

/* End of file Payment.php */
/* Location: ./application/libraries/Payment.php */
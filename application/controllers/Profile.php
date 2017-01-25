<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct() {

		parent::__construct();

		if(!$this->data['user']) {
			$this->session->set_flashdata('error_message', lang('not_authorized'));
			redirect(locale_url());
		}

		$this->data['prof_highlighted'] = 'none';

		$purifier = new HTMLPurifier;
		$user = $this->data['user'];
		
		foreach($user as $k => $u) {
			$user->$k = $purifier->purify($u);
		}

		$this->data['user'] = $user;
	}


	/*	VIEWS	*/

	public function index() {

		$this->load->library('form_validation');

		if($this->input->post()) {

			if($this->form_validation->run('change_profile')) {

				$data = array();
				$successful = TRUE;

				$user = $this->data['user'];

				$email = $this->input->post('email');
				$phone = $this->input->post('phone');

				if($email !== $user->email) {
					if(!$this->User->get_by_key('email', $email)) {
						$data['email'] = $email;
					}

					else {
						$this->data['error_message'] = lang('email_already_registered');
						$successful = FALSE;
					}
				}

				if($phone !== $user->phone) {
					if(!$this->User->get_by_key('phone', $phone)) {
						$data['phone'] = $phone;
					}

					else {
						$this->data['error_message'] = lang('phone_already_registered');
						$successful = FALSE;
					}
				}

				if($successful) {

					$data['id'] = $user->id;
					$data['first_name'] = $this->input->post('first_name');
					$data['last_name'] = $this->input->post('last_name');
					$data['personal_number'] = $this->input->post('personal_number');

					if($this->User->edit($data)) {
						$this->data['success_message'] = lang('changed_successfully');
						$this->data['user'] = $this->auth->get_current_user(TRUE);
					}

					else {
						$this->data['error_message'] = lang('unexpected_error');
					}
				}
			}

			else {
				$this->data['error_message'] = validation_errors('<div>', '</div>');
			}
		}
		
		$this->data['prof_highlighted'] = 'details';
		$this->data['title'] = lang('profile').' | '.$this->data['title'];

		$this->load->view('pages/profile', $this->data);
	}

	public function orders() {

		$this->load->model('Order');
		
		$this->data['orders'] = $this->Order->get_for_user($this->data['user']->id);

		$this->data['prof_highlighted'] = 'orders';
		$this->data['title'] = lang('my_orders').' | '.$this->data['title'];

		$this->load->view('pages/my_orders', $this->data);
	}

	public function addresses() {

		$this->load->model('Address');
		
		$this->data['addresses'] = $this->Address->get_for_user($this->data['user']->id);

		$this->data['prof_highlighted'] = 'addresses';
		$this->data['title'] = lang('addresses').' | '.$this->data['title'];

		$this->load->view('pages/addresses', $this->data);
	}


	/*	REDIRECTS	*/

	public function order($address) {

		$this->load->model(array('Address', 'Order', 'Product'));
		$this->load->library('Payment');

		$user = $this->data['user'];

		$address = $this->Address->get($address);

		if(!$address || $address->user !== $user->id) {
			redirect($this->agent->referrer());
		}

		$cart = $this->data['cart'];

		$products = $this->Product->get_cart(array_keys($cart));

		$ip = $this->input->ip_address();
		$amount = 0;
		$ka_description = '';
		$en_description = '';
		$ru_description = '';

		foreach($products as $p) {
			$amount += $cart[$p->id]*$p->price;

			$d = $p->ka_name.' x '.$cart[$p->id];

			if(mb_strlen($ka_description)) {
				$ka_description .= ', '.$d;
			}

			else {
				$ka_description .= $d;
			}

			$d = $p->en_name.' x '.$cart[$p->id];

			if(mb_strlen($en_description)) {
				$en_description .= ', '.$d;
			}

			else {
				$en_description .= $d;
			}

			$d = $p->ru_name.' x '.$cart[$p->id];

			if(mb_strlen($ru_description)) {
				$ru_description .= ', '.$d;
			}

			else {
				$ru_description .= $d;
			}
		}

		$transaction_id = $this->payment->get_transaction_id($amount * 100, $ip);

		if($transaction_id) {

			$data['user'] = $user->id;
			$data['address'] = $address->address.', '.$address->city.', '.$address->zip_code;
			$data['ka_description'] = $ka_description;
			$data['en_description'] = $en_description;
			$data['ru_description'] = $ru_description;
			$data['status'] = PENDING;
			$data['amount'] = $amount;
			$data['transaction_id'] = $transaction_id;
		}

		if($this->Order->add($data)) {
			$this->session->unset_userdata('cart');

			$this->load->view('pages/form', array(
				'trans_id' => $transaction_id,
			));

			return;
		}

		redirect($this->agent->referrer());
	}

	public function change_password() {

		$this->load->library('form_validation');

		if($this->form_validation->run('change_password')) {

			$password = $this->input->post('password');
			$user = $this->data['user'];

			if($this->User->change_password($user->id, $password)) {
				$this->session->set_flashdata('success_message', lang('changed_successfully'));
			}

			else {
				$this->session->set_flashdata('error_message', lang('unexpected_error'));
			}
		}

		else {
			$this->session->set_flashdata('error_message', validation_errors('<div>', '</div>'));
		}

		redirect($this->agent->referrer());
	}

	public function add_address() {

		$this->load->library('form_validation');

		if($this->form_validation->run('add_address')) {

			$this->load->model('Address');

			$data = array();

			$data['user'] = $this->data['user']->id;
			$data['address'] = $this->input->post('address');
			$data['city'] = $this->input->post('city');
			$data['zip_code'] = $this->input->post('zip_code');

			if($this->Address->add($data)) {
				$this->session->set_flashdata('success_message', lang('added_successfully'));
			}

			else {
				$this->session->set_flashdata('error_message', lang('unexpected_error'));
			}
		}

		else {
			$this->session->set_flashdata('error_message', validation_errors('<div>', '</div>'));
		}

		redirect($this->agent->referrer());
	}

	public function delete_address($id) {

		$this->load->model('Address');

		$address = $this->Address->get($id);

		if($address->user === $this->data['user']->id) {
			if($this->Address->delete($id)) {
				$this->session->set_flashdata('success_message', lang('deleted_successfully'));
			}

			else {
				$this->session->set_flashdata('error_message', lang('unexpected_error'));
			}
		}

		else {
			$this->session->set_flashdata('error_message', lang('unexpected_error'));
		}

		redirect($this->agent->referrer());
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */
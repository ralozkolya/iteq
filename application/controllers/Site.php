<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}


	/*	VIEWS	*/

	public function index() {

		$this->home();
	}

	public function home() {

		$this->load->model(array('Banner', 'Category', 'Pinned_link'));

		$this->data['banners'] = $this->Banner->get_list();
		$this->data['page'] = $this->Page->get_by_key('slug', 'home');
		$this->data['pinned_links'] = $this->Pinned_link->get_pinned_list();

		$this->data['highlighted'] = 'home';

		$this->load->view('pages/home', $this->data);
	}

	public function products($page = 1) {

		$this->load_products('products', $page);
	}

	public function product($id, $slug = NULL) {

		$this->load->model(array('Product', 'Gallery'));

		$this->data['product'] = $this->Product->get_product($id);

		if(!$this->data['product']) {
			show_404();
		}

		$this->data['images'] = $this->Gallery->get_for_product($id);
		$this->data['highlighted'] = 'products';

		$this->load->view('pages/product', $this->data);
	}

	public function shop($page = 1) {

		$this->load_products('shop', $page);
	}

	public function brands() {

		$this->load->model('Brand');

		$this->data['brands'] = $this->Brand->get_list();
		$this->data['highlighted'] = 'brands';
		$this->data['title'] = lang('brands').' | '.$this->data['title'];

		$this->load->view('pages/brands', $this->data);
	}

	public function about_us() {

		$this->data['page'] = $this->Page->get_by_key('slug', 'about_us');
		$this->data['highlighted'] = 'about_us';
		$this->data['title'] = lang('about_us').' | '.$this->data['title'];

		$this->load->view('pages/generic_page', $this->data);
	}

	public function contact() {

		$this->load->library('form_validation');
		$this->load->helper('form');

		if($this->input->post()) {
			$this->send_message();
		}

		$this->data['page'] = $this->Page->get_by_key('slug', 'contact');

		$this->data['highlighted'] = 'contact';
		$this->data['title'] = lang('contact').' | '.$this->data['title'];

		$this->load->view('pages/contact', $this->data);
	}

	public function cart() {

		$this->load->model('Product');

		if(!empty($this->data['cart'])) {
			$this->data['products'] = $this->Product->get_cart(array_keys($this->data['cart']));
		}

		$this->data['title'] = lang('cart').' | '.$this->data['title'];

		$this->load->view('pages/cart', $this->data);
	}

	public function credit() {

		$user = $this->data['user'];

		if(!$user) {
			redirect(locale_url('login'));
		}

		$this->load->model(['Product', 'Address', 'Gallery']);

		$this->data['addresses'] = $this->Address->get_for_user($user->id);
		$this->data['product'] = $product = $this->Product->get($this->input->get('product'));
		$this->data['images'] = $this->Gallery->get_for_product($product->id);

		if(!$product) {
			show_404();
		}

		if($product->price < 50) {
			$this->session->set_flashdata('error_message', lang('min_credit'));
			redirect($this->agent->referrer());
		}

		$this->load->view('pages/credit', $this->data);
	}

	public function confirm_credit() {

		$user = $this->data['user'];

		if(!$user) {
			redirect(locale_url());
		}

		$this->load->library('Okey');

		$post = $this->input->post();

		$this->okey->check($user->id, $post['address'], $post['product']);
	}

	public function confirm_order() {

		$user = $this->data['user'];

		if(!$user) {
			redirect(locale_url('login'));
		}

		$this->load->model(['Product', 'Address']);

		$this->data['addresses'] = $this->Address->get_for_user($user->id);

		if(empty($this->data['cart'])) {
			redirect(locale_url());
		}

		$this->data['products'] = $this->Product->get_cart(array_keys($this->data['cart']));
		$this->data['title'] = lang('confirm_order').' | '.$this->data['title'];

		$this->load->view('pages/confirm_order', $this->data);
	}

	public function login() {

		if($this->data['user']) {
			redirect(locale_url());
		}

		$post = $this->input->post();

		if($post) {

			$email = $post['email'];
			$password = $post['password'];

			if($this->auth->login($email, $password)) {
				$referrer = $this->session->flashdata('referrer');
				$referrer = empty($referrer) ? locale_url() : $referrer;
				redirect($referrer);
			}

			else {
				$this->session->set_flashdata('error_message', lang('incorrect_credentials'));
				redirect(current_url());
			}
		}

		$this->data['title'] = lang('login').' | '.$this->data['title'];
		$this->session->set_flashdata('referrer', $this->agent->referrer());

		$this->load->view('pages/login', $this->data);
	}

	public function register() {

		if($this->data['user']) {
			redirect(locale_url());
		}

		$this->load->library('form_validation');

		$post = $this->input->post();

		if($post) {

			if($this->form_validation->run('register')) {

				if($this->User->add($post)) {
					$this->session->set_flashdata('success_message', lang('registration_successfull'));
					redirect(locale_url('login'));
				}
			}

			else {
				$this->data['error_message'] = validation_errors('<div>', '</div>');
			}
		}

		$this->data['title'] = lang('register').' | '.$this->data['title'];

		$this->load->view('pages/register', $this->data);
	}

	public function recover_password() {

		if($this->data['user']) {
			redirect(locale_url());
		}

		$post = $this->input->post();

		if($post) {

			$email = $post['email'];

			$user = $this->User->get_by_key('email', $email);

			if($user) {

				$this->load->helper('email_sender');

				send_recovery($user);
			}

			$this->data['success_message'] = lang('recovery_sent');


		}

		$this->data['title'] = lang('recover_password').' | '.$this->data['title'];

		$this->load->view('pages/recover_password', $this->data);
	}

	public function check_token($token) {

		$user = $this->User->get_by_key('token', $token);

		if($user) {

			if($this->auth->login_by_id($user->id)) {

				$this->User->edit(array(
					'id' => $user->id,
					'token' => '',
				));

				$this->session->set_flashdata('error_message', lang('change_password'));
				redirect(locale_url('profile'));
			}
		}

		$this->session->set_flashdata('error_message', lang('unexpected_error'));
		redirect(locale_url());
	}


	/*	REDIRECTS	*/

	public function transactions_status($status) {

		if($status === 'success') {

			$this->load->library('Payment');
			$this->load->model(array('Order', 'User'));
			$this->load->helper('email_sender');

			$ip = $this->input->ip_address();
			$transaction_id = $this->input->post('trans_id');

			$result = $this->payment->get_transaction_status($transaction_id, $ip);

			$order = $this->Order->get_by_key('transaction_id', $transaction_id);
			$user = $this->User->get($order->user);

			if($order && $user && $user->id === $this->data['user']->id) {

				if($order->status == PENDING) {

					if(!empty($result['RESULT']) && $result['RESULT'] === 'OK') {

						if($this->Order->edit(array(
							'id' => $order->id,
							'status' => COMPLETED,
						))) {

							send_order($user->email);

							$this->session->set_flashdata('success_message', lang('order_placed'));
						}

						else {
							$this->session->set_flashdata('error_message', lang('unexpected_error'));
						}
					}

					else {

						$this->Order->edit(array(
							'id' => $order->id,
							'status' => FAILED,
						));

						$this->session->set_flashdata('error_message', lang('unexpected_error'));
					}
				}

				elseif($order->status == COMPLETED) {
					$this->session->set_flashdata('error_message', lang('order_already_processed'));
				}

				else {
					$this->session->set_flashdata('error_message', lang('unexpected_error'));
				}
			}

			else {
				$this->session->set_flashdata('error_message', lang('unexpected_error'));
			}
		}

		else {
			$this->session->set_flashdata('error_message', lang('unexpected_error'));
		}

		redirect(locale_url('profile/orders'));
	}

	public function logout() {

		$this->auth->logout();
		redirect($this->agent->referrer());
	}

	public function add_to_cart($id, $amount = 1) {

		$this->load->model('Product');

		$product = $this->Product->get($id);

		if($product && $product->for_sale) {

			$cart = $this->session->userdata('cart');

			if(empty($cart)) {
				$cart = array();
			}

			if(array_key_exists($id, $cart)) {
				$in_cart = $cart[$id];
				$cart[$id] = $in_cart + ($amount - $in_cart);
			}

			else {
				$cart[$id] = 1;
			}

			if($cart[$id] <= $product->in_stock) {
				$this->session->set_userdata('cart', $cart);
			}

			else {
				$this->session->set_flashdata('error_message', lang('out_of_stock'));
			}
		}

		redirect($this->agent->referrer());
	}

	public function delete_from_cart($id) {

		$cart = $this->data['cart'];

		unset($cart[$id]);

		$this->session->set_userdata('cart', $cart);

		redirect($this->agent->referrer());
	}

	public function clear_cart() {

		$this->session->unset_userdata('cart');

		redirect($this->agent->referrer());
	}


	/*	XML	*/

	public function sitemap() {

		header('Content-Type: text/xml; charset="utf-8"');

		$this->load->model('Product');

		$this->data['products'] = $this->Product->get_list();

		$this->load->view('xml/sitemap', $this->data);
	}


	/*	AJAX	*/

	public function send_message() {

		$this->load->library('form_validation');

		if($this->form_validation->run('send_message')) {
			$this->load->helper('email_sender');
			send_message($this->input->post());
		}
	}


	/*	PRIVATE METHODS	*/

	private function load_products($type, $page) {

		$this->load->model(array('Product', 'Category'));

		$filter = $this->input->get();

		if($type === 'shop') {
			$filter['for_sale'] = 1;
			$this->data['highlighted'] = 'shop';
			$this->data['title'] = lang('shop').' | '.$this->data['title'];
		}

		else {
			$this->data['highlighted'] = 'products';
			$this->data['title'] = lang('products').' | '.$this->data['title'];
		}

		$result = $this->Product->get_filtered($filter, $page);

		$this->config->load('pagination');
		$config = $this->config->item('pagination');

		$config['base_url'] = locale_url("{$type}");
		$config['total_rows'] = $result['rows'];
		$config['per_page'] = PRODUCTS_PER_PAGE;

		if (count($_GET) > 0) {
			$config['suffix'] = '?' . http_build_query($_GET, '', "&");
			$config['first_url'] = $config['base_url'].$config['suffix'];
		}

		$this->load->library('pagination', $config);

		$this->data['categories'] = $this->Category->get_list_with_subcategories();
		$this->data['products'] = $result['products'];

		$this->data['category'] = html_escape($this->input->get('category'));
		$this->data['sort'] = html_escape($this->input->get('sort'));
		$this->data['search'] = html_escape($this->input->get('search'));

		$this->load->view('pages/products', $this->data);
	}
}

/* End of file Site.php */
/* Location: ./application/controllers/Site.php */

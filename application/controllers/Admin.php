<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $data = array(
		'title' => 'Control Panel - ITEQ.ge',
		'highlighted' => 'none',
	);

	public function __construct() {

		parent::__construct();

		$this->config->set_item('language', EN);

		$this->load->language('admin');

		$this->load->model(array(
			'Banner', 'Brand', 'Category', 'Gallery',
			'Page', 'Pinned_link', 'Product', 'User',
			'User_admin', 'Order', 'Address',
		));

		$this->load->library(array('Auth_admin' => 'auth', 'form_validation'));

		$this->data['user'] = $this->auth->get_current_user();

		if(!$this->data['user']) {
			$this->auth->logout();
			$this->session->set_flashdata('error_message', lang('unauthorized'));
			redirect(base_url('login'));
		}
	}

	public function index() {
		
		$this->products();
	}

	public function categories() {

		$post = $this->input->post();

		if($post) {
			$this->add('Category', $post);
		}

		$this->data['categories'] = $this->Category->get_top();
		$this->data['highlighted'] = 'categories';

		$this->load->view('pages/admin/categories', $this->data);
	}

	public function category($id) {

		$post = $this->input->post();

		if($post) {

			if(!empty($post['id'])) {
				$this->edit('Category', $post);
			}

			else {
				$this->add('Category', $post);
			}
		}
		
		$this->data['category'] = $this->Category->get($id);
		$this->data['categories'] = $this->Category->get_top();
		$this->data['subcategories'] = $this->Category->get_subcategories($id);
		$this->data['products'] = $this->Product->get_filtered(array(
			'category' => $this->data['category']->slug,
		))['products'];
		$this->data['highlighted'] = 'categories';

		$this->load->view('pages/admin/category', $this->data);
	}

	public function products($page = 1) {

		$post = $this->input->post();

		if($post) {

			if(!empty($post['id'])) {
				$this->edit('Product', $post);
			}

			else {
				$this->add('Product', $post);
			}
		}

		$products = $this->Product->get_list_admin($page);

		$this->data['products'] = $products['products'];

		$this->config->load('pagination');
		$config = $this->config->item('pagination');

		$config['base_url'] = base_url('admin/products/');
		$config['total_rows'] = $products['total_rows'];
		$config['per_page'] = ITEMS_PER_PAGE_ADMIN;

		$this->load->library('pagination', $config);

		$this->data['categories'] = $this->Category->get_list_with_subcategories();

		$this->data['highlighted'] = 'products';

		$this->load->view('pages/admin/products', $this->data);
	}

	public function product($id) {

		$post = $this->input->post();

		if($post) {

			if(!empty($post['id'])) {
				$this->edit('Product', $post);
			}

			else {
				$this->add('Product', $post);
			}
		}
		
		$this->data['product'] = $this->Product->get($id);
		$this->data['gallery'] = $this->Gallery->get_for_product($id);
		$this->data['categories'] = $this->Category->get_list_with_subcategories();
		$this->data['highlighted'] = 'products';

		$this->load->view('pages/admin/product', $this->data);
	}

	public function banners() {

		$post = $this->input->post();

		if($post) {

			$config = array();
			$config['allowed_types'] = 'png|jpg|gif';
			$config['upload_path'] = 'static/uploads/banners/';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if($this->upload->do_upload('image')) {

				$upload = $this->upload->data();
				$post['image'] = $upload['file_name'];

				$this->add('Banner', $post);
			}

			else {
				$this->data['error_message'] = $this->upload->display_errors();
			}
		}

		$this->data['highlighted'] = 'banners';
		$this->data['banners'] = $this->Banner->get_list();
		$this->data['priority'] = $this->Banner->get_next_priority();

		$this->load->view('pages/admin/banners', $this->data);
	}

	public function banner($id) {

		$post = $this->input->post();

		if($post) {

			$this->edit('Banner', $post);
		}

		$this->data['highlighted'] = 'banners';
		$this->data['banner'] = $this->Banner->get($id);

		$this->load->view('pages/admin/banner', $this->data);
	}

	public function pinned_links() {

		$post = $this->input->post();

		if($post) {

			$this->load->library(array('upload', 'image_lib'));

			$config = array();
			$config['allowed_types'] = 'png|jpg|gif';
			$config['upload_path'] = 'static/uploads/pinned_links/';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if($this->upload->do_upload('image')) {

				$upload = $this->upload->data();

				$new_image = 'static/uploads/pinned_links/thumbs/'.$upload['file_name'];

				if(isset($upload['full_path'])) {

					$config = array();
					$config['source_image'] = $upload['full_path'];
					$config['source_image'] = $upload['full_path'];
					$config['width'] = 400;
					$config['height'] = 300;
					$config['maintain_ratio'] = TRUE;
					$config['new_image'] = $new_image;

					$this->image_lib->initialize($config);
					$this->image_lib->resize();
				}

				else {
					$this->data['error_message'] = $this->image_lib->display_errors();
				}

				$post['image'] = $upload['file_name'];

				$this->add('Pinned_link', $post);

				if(file_exists($upload['full_path'])) {
					unlink($upload['full_path']);
				}

				if(file_exists($new_image)) {
					unlink($new_image);
				}
			}

			else {
				$this->data['error_message'] = $this->upload->display_errors();
			}
		}

		$this->data['highlighted'] = 'pinned';
		$this->data['pinned_links'] = $this->Pinned_link->get_list();
		$this->data['priority'] = $this->Pinned_link->get_next_priority();

		$this->load->view('pages/admin/pinned_links', $this->data);
	}

	public function pinned_link($id) {

		$post = $this->input->post();
		$new_image;

		if($post) {

			$this->load->library(array('upload', 'image_lib'));

			$config = array();
			$config['allowed_types'] = 'png|jpg|gif';
			$config['upload_path'] = 'static/uploads/pinned_links/';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if($this->upload->do_upload('image')) {

				$upload = $this->upload->data();

				$new_image = 'static/uploads/pinned_links/thumbs/'.$upload['file_name'];

				if(isset($upload['full_path'])) {

					$config = array();
					$config['source_image'] = $upload['full_path'];
					$config['source_image'] = $upload['full_path'];
					$config['width'] = 400;
					$config['height'] = 300;
					$config['maintain_ratio'] = TRUE;
					$config['new_image'] = $new_image;

					$this->image_lib->initialize($config);
					$this->image_lib->resize();
				}

				else {
					$this->data['error_message'] = $this->image_lib->display_errors();
				}

				$post['image'] = $upload['file_name'];
			}

			else {
				$this->data['error_message'] = $this->upload->display_errors();
			}

			$this->edit('Pinned_link', $post);

			if(!empty($upload)) {
				if(file_exists($upload['full_path'])) {
					unlink($upload['full_path']);
				}

				if(file_exists($new_image)) {
					unlink($new_image);
				}
			}
		}

		$this->data['highlighted'] = 'pinned';
		$this->data['pinned_link'] = $this->Pinned_link->get($id);

		$this->load->view('pages/admin/pinned_link', $this->data);
	}

	public function pages() {

		$this->data['pages'] = $this->Page->get_list();
		$this->data['highlighted'] = 'pages';

		$this->load->view('pages/admin/pages', $this->data);
	}

	public function page($id) {

		$post = $this->input->post();

		if($post) {

			if(!empty($post['id'])) {
				$this->edit('Page', $post);
			}
		}

		$this->data['page'] = $this->Page->get($id);
		$this->data['highlighted'] = 'pages';

		$this->load->view('pages/admin/page', $this->data);
	}

	public function brands() {

		$post = $this->input->post();

		if($post) {

			$this->load->library(array('upload', 'image_lib'));

			$config = array();
			$config['allowed_types'] = 'png|jpg|gif';
			$config['upload_path'] = 'static/uploads/brands/';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if($this->upload->do_upload('image')) {

				$upload = $this->upload->data();

				$new_image = 'static/uploads/brands/thumbs/'.$upload['file_name'];

				if(isset($upload['full_path'])) {

					$config = array();
					$config['source_image'] = $upload['full_path'];
					$config['source_image'] = $upload['full_path'];
					$config['width'] = 400;
					$config['height'] = 300;
					$config['maintain_ratio'] = TRUE;
					$config['new_image'] = $new_image;

					$this->image_lib->initialize($config);
					$this->image_lib->resize();
				}

				else {
					$this->data['error_message'] = $this->image_lib->display_errors();
				}

				$post['image'] = $upload['file_name'];

				$this->add('Brand', $post);

				if(file_exists($upload['full_path'])) {
					unlink($upload['full_path']);
				}

				if(file_exists($new_image)) {
					unlink($new_image);
				}
			}

			else {
				$this->data['error_message'] = $this->upload->display_errors();
			}
		}

		$this->data['highlighted'] = 'brands';
		$this->data['brands'] = $this->Brand->get_list();
		$this->data['priority'] = $this->Brand->get_next_priority();

		$this->load->view('pages/admin/brands', $this->data);
	}

	public function brand($id) {

		$post = $this->input->post();
		$new_image;

		if($post) {

			$this->load->library(array('upload', 'image_lib'));

			$config = array();
			$config['allowed_types'] = 'png|jpg|gif';
			$config['upload_path'] = 'static/uploads/brands/';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if($this->upload->do_upload('image')) {

				$upload = $this->upload->data();

				$new_image = 'static/uploads/brands/thumbs/'.$upload['file_name'];

				if(isset($upload['full_path'])) {

					$config = array();
					$config['source_image'] = $upload['full_path'];
					$config['source_image'] = $upload['full_path'];
					$config['width'] = 400;
					$config['height'] = 300;
					$config['maintain_ratio'] = TRUE;
					$config['new_image'] = $new_image;

					$this->image_lib->initialize($config);
					$this->image_lib->resize();
				}

				else {
					$this->data['error_message'] = $this->image_lib->display_errors();
				}

				$post['image'] = $upload['file_name'];
			}

			else {
				$this->data['error_message'] = $this->upload->display_errors();
			}

			$this->edit('Brand', $post);

			if(!empty($upload)) {
				if(file_exists($upload['full_path'])) {
					unlink($upload['full_path']);
				}

				if(file_exists($new_image)) {
					unlink($new_image);
				}
			}
		}

		$this->data['highlighted'] = 'brands';
		$this->data['brand'] = $this->Brand->get($id);

		$this->load->view('pages/admin/brand', $this->data);
	}

	public function orders($page = 1) {

		$orders = $this->Order->get_list_admin($page);
		$this->data['orders'] = $orders['orders'];

		$this->config->load('pagination');
		$config = $this->config->item('pagination');

		$config['base_url'] = base_url('admin/orders/');
		$config['total_rows'] = $orders['total_rows'];
		$config['per_page'] = ITEMS_PER_PAGE_ADMIN;

		$this->load->library('pagination', $config);

		$this->data['highlighted'] = 'orders';

		$this->load->view('pages/admin/orders', $this->data);
	}

	public function customers($page = 1) {

		$users = $this->User->get_list_admin($page);
		$this->data['customers'] = $users['users'];

		$this->config->load('pagination');
		$config = $this->config->item('pagination');

		$config['base_url'] = base_url('admin/customers/');
		$config['total_rows'] = $users['total_rows'];
		$config['per_page'] = ITEMS_PER_PAGE_ADMIN;

		$this->load->library('pagination', $config);

		$this->data['highlighted'] = 'customers';

		$this->load->view('pages/admin/customers', $this->data);
	}

	public function customer($id) {

		$customer = $this->User->get($id);

		if(!$customer) {
			show_404();
		}

		$this->data['orders'] = $this->Order->get_for_user($customer->id);
		$this->data['addresses'] = $this->Address->get_for_user($customer->id);
		$this->data['customer'] = $customer;

		$this->data['highlighted'] = 'customers';

		$this->load->view('pages/admin/customer', $this->data);
	}

	public function upload_images() {

		if(!$this->form_validation->run('add_images')) {
			$this->session->set_flashdata('error_message', validation_errors());
			redirect($this->agent->referrer());
		}

		$this->add_images($this->input->post('product'), TRUE);
		
		redirect($this->agent->referrer());
	}

	public function user() {

		if($this->input->post()) {

			if($this->form_validation->run('change_password')) {

				$user = $this->data['user']->id;
				$password = $this->input->post('password');

				if($this->User_admin->edit_password($user, $password)) {
					$this->data['success_message'] = lang('changed_successfully');
				}

				else {
					$this->data['error_message'] = lang('unexpected_error');
				}
			}

			else {
				$this->data['error_message'] = validation_errors('<div>', '</div>');
			}
		}

		$this->data['highlighted'] = 'user';

		$this->load->view('pages/admin/user', $this->data);
	}


	public function add($type, $data) {

		$allowed = array(
			'Banner', 'Product', 'Gallery', 'Category', 'Pinned_link', 'Brand',
		);

		$is_allowed = FALSE;

		foreach($allowed as $a) {
			if($type === $a) {
				$is_allowed = TRUE;
				break;
			}
		}

		if(!$is_allowed) {
			$this->redirect();
		}

		if(empty($data)) {
			$data = $this->input->post();
		}

		if(isset($data[$this->security->get_csrf_token_name()])) {
			unset($data[$this->security->get_csrf_token_name()]);
		}

		if($this->form_validation->run('add_'.$type)) {
			if($this->$type->add($data)) {

				if($type === 'Product') {

					$this->add_images($this->db->insert_id());
				}

				$this->session->set_flashdata('success_message', lang('added_successfully'));
				$this->redirect();
			}

			else {
				$this->session->set_flashdata('error_message', lang('unexpected_error'));
			}
		}

		else {
			$this->data['error_message'] = validation_errors('<div>', '</div>');
		}
	}

	public function edit($type, $data) {

		$allowed = array(
			'Banner', 'Product', 'Gallery', 'Category', 'Page', 'Pinned_link', 'Brand',
		);

		$is_allowed = FALSE;

		foreach($allowed as $a) {
			if($type === $a) {
				$is_allowed = TRUE;
				break;
			}
		}

		if(!$is_allowed) {
			$this->redirect();
		}

		if(empty($data)) {
			$data = $this->input->post();
		}

		if(isset($data[$this->security->get_csrf_token_name()])) {
			unset($data[$this->security->get_csrf_token_name()]);
		}

		if($this->form_validation->run('edit_'.$type)) {

			if($this->$type->edit($data)) {
				$this->session->set_flashdata('success_message', lang('changed_successfully'));
				$this->redirect();
			}

			else {
				$this->data['error_message'] = lang('unexpected_error');
			}
		}

		else {
			$this->data['error_message'] = validation_errors('<div>', '</div>');
		}
	}


	public function delete($type, $id) {

		$allowed = array(
			'Banner', 'Product', 'Gallery', 'Category', 'Pinned_link', 'Brand',
		);

		$is_allowed = FALSE;

		foreach($allowed as $a) {
			if($type === $a) {
				$is_allowed = TRUE;
				break;
			}
		}

		if(!$is_allowed) {
			$this->redirect();
		}

		if($this->$type->delete($id)) {
			$this->session->set_flashdata('success_message', lang('deleted_successfully'));
		}

		else {
			$this->session->set_flashdata('error_message', lang('unexpected_error'));
		}

		$this->redirect();
	}

	private function add_images($product, $display_error = FALSE) {

		$this->load->library(array('image_lib', 'upload'));

		$config = array();
		$config['allowed_types'] = 'png|jpg|gif';
		$config['upload_path'] = 'static/uploads/products/';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		$files = $_FILES;

		$cpt = count($_FILES['images']['name']);

		for($i = 0; $i < $cpt; $i++) {

			$_FILES['images']['name'] = $files['images']['name'][$i];
			$_FILES['images']['type'] = $files['images']['type'][$i];
			$_FILES['images']['tmp_name'] = $files['images']['tmp_name'][$i];
			$_FILES['images']['error'] = $files['images']['error'][$i];
			$_FILES['images']['size'] = $files['images']['size'][$i];

			if($this->upload->do_upload('images')) {

				$upload = $this->upload->data();

				if(isset($upload['full_path'])) {

					$config = array();
					$config['source_image'] = $upload['full_path'];
					$config['source_image'] = $upload['full_path'];
					$config['width'] = 300;
					$config['height'] = 300;
					$config['maintain_ratio'] = TRUE;
					$config['new_image'] = 'static/uploads/products/thumbs/'.$upload['file_name'];

					$this->image_lib->initialize($config);
					$this->image_lib->resize();
				}

				elseif($display_error) {
					$this->data['error_message'] = $this->image_lib->display_errors();
				}

				$data = array();

				$data['product'] = $product;
				$data['image'] = $upload['file_name'];

				$this->Gallery->add($data);
				$this->session->set_flashdata('success_message', lang('added_successfully'));
			}

			elseif($display_error) {
				$this->session->set_flashdata('error_message', $this->upload->display_errors());
			}
		}
	}

	private function redirect() {

		if($this->agent->referrer()) {
			redirect($this->agent->referrer());
		}

		redirect(base_url('admin'));
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends MY_Model {

	protected $table = 'banners';

	public function add($data) {

		if(!empty($data['link'])) {
			$data['link'] = prep_url($data['link']);
		}

		return parent::add($data);
	}

	public function edit($data) {

		if(empty($data['blank'])) {
			$data['blank'] = 0;
		}

		if(!empty($data['link'])) {
			$data['link'] = prep_url($data['link']);
		}

		return parent::edit($data);
	}

	public function get_list($limit = NULL, $offset = NULL) {

		$this->db->order_by('priority');

		return parent::get_list();
	}

	public function delete($id) {

		$img = $this->get($id);
		$path = 'static/uploads/banners/';

		$name = $path.$img->image;

		if(file_exists($name) && !is_dir($name)) {

			unlink($name);
		}

		return parent::delete($id);
	}

	public function get_next_priority() {

		$this->db->select_max('priority');

		return $this->db->get($this->table)->row()->priority + 5;
	}

}

/* End of file Banner.php */
/* Location: ./application/models/Banner.php */
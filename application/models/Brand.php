<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends MY_Model {

	protected $table = 'brands';

	public function get($id) {

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			'*',
			$lang.'_name as name',
		));

		return parent::get($id);
	}

	public function get_list($limit = NULL, $offset = NULL) {

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			'*',
			$lang.'_name as name',
		));

		$this->db->order_by('priority');

		return parent::get_list($limit, $offset);
	}

	public function get_next_priority() {

		$this->db->select_max('priority');

		return $this->db->get($this->table)->row()->priority + 5;
	}

	public function edit($data) {

		if(!empty($data['image'])) {

			$link = $this->get($data['id']);
			$path = 'static/uploads/brands/';

			$name = $path.$link->image;

			if(file_exists($name)) {
				unlink($name);
			}

			$name = $path.'thumbs/'.$link->image;

			if(file_exists($name)) {
				unlink($name);
			}
		}

		if(!empty($data['link'])) {
			$data['link'] = prep_url($data['link']);
		}

		return parent::edit($data);
	}

	public function delete($id) {

		$img = $this->get($id);
		$path = 'static/uploads/brands/';

		$name = $path.$img->image;

		if(file_exists($name) && !is_dir($name)) {

			unlink($name);
		}

		$name = $path.'thumbs/'.$img->image;

		if(file_exists($name) && !is_dir($name)) {

			unlink($name);
		}

		return parent::delete($id);
	}

}

/* End of file Brand.php */
/* Location: ./application/models/Brand.php */
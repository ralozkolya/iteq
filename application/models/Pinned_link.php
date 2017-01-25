<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinned_link extends MY_Model {

	protected $table = 'pinned_links';

	public function add($data) {

		if(!empty($data['link'])) {
			$data['link'] = prep_url($data['link']);
		}

		return parent::add($data);
	}

	public function edit($data) {

		if(!empty($data['image'])) {

			$link = $this->get($data['id']);
			$path = 'static/uploads/pinned_links/';

			$name = $path.$link->image;

			if(file_exists($name)) {
				unlink($name);
			}

			$name = $path.'thumbs/'.$link->image;

			if(file_exists($name)) {
				unlink($name);
			}
		}

		if(empty($data['blank'])) {
			$data['blank'] = 0;
		}

		if(!empty($data['link'])) {
			$data['link'] = prep_url($data['link']);
		}

		return parent::edit($data);
	}

	public function get_list($limit = NULL, $offset = NULL) {

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			'*', $lang.'_description as description',
		));

		return parent::get_list();
	}

	public function get_pinned_list() {

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			$lang.'_description as description',
			'image', 'blank', 'link',
		));

		$this->db->order_by('priority');

		return parent::get_list();
	}

	public function get_next_priority() {

		$this->db->select_max('priority');

		return $this->db->get($this->table)->row()->priority + 5;
	}

	public function delete($id) {

		$img = $this->get($id);
		$path = 'static/uploads/pinned_links/';

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

/* End of file Pinned_link.php */
/* Location: ./application/models/Pinned_link.php */
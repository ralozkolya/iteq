<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Model {

	protected $table = 'categories';

	public function get($id) {

		$lang = get_lang_code(get_lang());
		
		$this->db->select(array(
			'*', $lang.'_name as name',
		));

		return parent::get($id);
	}

	public function get_top() {

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			'*',
			$lang.'_name as name',
			'slug',
		));

		$this->db->where('parent', 0);

		return parent::get_list();
	}

	public function get_subcategories($id) {

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			'*', $lang.'_name as name',
		));

		$this->db->where('parent', $id);

		return parent::get_list();
	}

	public function get_list_with_subcategories() {

		$lang = get_lang_code(get_lang());

		$this->db->where('parent', 0);

		$this->db->select(array(
			$lang.'_name as name',
			'id', 'parent', 'slug',
		));

		$r = parent::get_list();

		foreach($r as $k => $s) {
			$this->db->where('parent', $s->id);

			$this->db->select(array(
				$lang.'_name as name',
				'id', 'parent', 'slug',
			));
			
			$s->sub = $this->db->get($this->table)->result();
		}

		return $r;
	}

	public function get_subcategory_ids($slug) {

		$parent = $this->get_by_key('slug', $slug)->id;

		$this->db->select('id');
		$this->db->where('parent', $parent);

		$subs = parent::get_list();
		$ids = array();
		
		foreach($subs as $s) {
			$ids[] = $s->id;
		}

		return $ids;
	}

	public function add($data) {

		if(empty($data['slug'])) {
			$data['slug'] = $this->generate_slug($data['en_name']);
		}

		return parent::add($data);
	}

	public function edit($data) {

		if($data['id'] === $data['parent']) {
			return FALSE;
		}

		return parent::edit($data);
	}

	public function delete($id) {

		$this->db->where('id', $id);

		$category = $this->db->get($this->table)->row();

		if($category && $category->parent == 0) {
			$categories = $this->get_subcategories($category->id);

			foreach($categories as $c) {
				$this->delete($c->id);
			}
		}

		$this->db->where('category', $id);
		$products = $this->Product->get_list();

		foreach($products as $p) {
			$this->Product->delete($p->id);
		}

		return parent::delete($id);
	}

}

/* End of file Category.php */
/* Location: ./application/models/Category.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Model {

	protected $table = 'products';

	public function get_product($id) {

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			'*',
			"products.id as id",
			"products.{$lang}_name as name",
			"products.{$lang}_description as description",
			"products.{$lang}_price_label as price_label",
			"categories.{$lang}_name as category_name",
			"categories.slug as category_slug",
		));

		$this->db->join('categories', 'categories.id = products.category');

		return parent::get($id);
	}

	public function get($id) {

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			'*',
			$lang.'_name as name',
			$lang.'_description as description',
			$lang.'_price_label as price_label',
		));

		return parent::get($id);
	}

	public function get_filtered($filter = NULL, $page = 1) {

		$page = abs($page - 1);

		$offset = $page * PRODUCTS_PER_PAGE;

		$this->filter($filter);

		$products = parent::get_list(PRODUCTS_PER_PAGE, $offset);
		
		$this->filter($filter);

		$rows = $this->db->get($this->table)->num_rows();

		return array(
			'products' => $products,
			'rows' => $rows,
		);
	}

	public function get_for_category($category) {

		$filter = ['category' => $category];

		$this->filter($filter);

		$products = parent::get_list();
		
		$this->filter($filter);

		$rows = $this->db->get($this->table)->num_rows();

		return array(
			'products' => $products,
			'rows' => $rows,
		);
	}

	public function get_cart($cart) {

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			$lang.'_name as name',
			$lang.'_description as description',
			'ka_name', 'en_name', 'ru_name',
			'products.id', 'slug', 'price', 'gallery.image',
		));

		$this->db->join('gallery', 'products.id = gallery.product', 'left');
		$this->db->group_by('products.id');

		$this->db->where_in('products.id', $cart);

		return $this->get_list();
	}

	public function get_list_admin($page = 1) {

		if(is_numeric($page)) {
			$page = abs($page - 1);
		}

		else {
			$page = 0;
		}

		$offset = $page * ITEMS_PER_PAGE_ADMIN;

		$lang = get_lang_code(get_lang());

		$this->db->select(array(
			'*', $lang.'_name as name',
		));

		$this->db->order_by('priority');

		$products = parent::get_list(ITEMS_PER_PAGE_ADMIN, $offset);

		$total_rows = $this->db->get($this->table)->num_rows();

		$result = array(
			'products' => $products,
			'total_rows' => $total_rows,
		);

		return $result;
	}

	public function add($data) {

		if(empty($data['slug'])) {
			$data['slug'] = $this->generate_slug($data['en_name']);
		}

		return parent::add($data);
	}

	public function change_priority($id, $priority) {
		
		return parent::edit([
			'id' => $id,
			'priority' => $priority,
		]);
	}

	public function edit($data) {

		if(!isset($data['for_sale'])) {
			$data['for_sale'] = 0;
		}

		return parent::edit($data);
	}

	public function delete($id) {

		$gallery = $this->Gallery->get_for_product($id);

		foreach($gallery as $g) {
			$this->Gallery->delete($g->id);
		}

		return parent::delete($id);
	}

	private function filter($filter, $just_rows = FALSE) {

		$lang = get_lang_code(get_lang());

		if(!empty($filter['category']) && $filter['category'] !== 'all') {

			$category = $filter['category'];

			$c = $this->Category->get_by_key('slug', $category);

			if($c->parent) {
				$this->db->where('category', $c->id);
			}

			else {
				$subs = $this->Category->get_subcategory_ids($category);

				$this->db->group_start();

				if(!empty($subs)) {
					$this->db->where_in('category', $subs);
				}

				$this->db->or_where('category', $c->id);

				$this->db->group_end();
			}
		}

		if(!$just_rows) {
			$this->db->select(array(
				$lang.'_name as name',
				$lang.'_description as description',
				'ka_name', 'en_name', 'ru_name', 'priority',
				'products.id', 'slug', 'price', 'gallery.image',
			));

			$this->db->join('gallery', 'products.id = gallery.product', 'left');
			$this->db->group_by('products.id');
		}

		else {
			$this->db->select('id');
		}

		if(!empty($filter['sort'])) {
			$sort = $filter['sort'];

			if($sort === SORT_DEFAULT) {
				$this->db->order_by('products.priority');
			}

			if($sort === SORT_ALPHA_ASC) {
				$this->db->order_by('products.'.$lang.'_name');
			}

			elseif($sort === SORT_ALPHA_DESC) {
				$this->db->order_by('products.'.$lang.'_name DESC');
			}

			elseif($sort === SORT_PRICE_ASC) {
				$this->db->order_by('price');
			}

			elseif($sort === SORT_PRICE_DESC) {
				$this->db->order_by('price DESC');
			}

			else {
				$this->db->order_by('products.priority');
			}
		}

		else {
			$this->db->order_by('products.priority');
		}

		if(!empty($filter['search'])) {
			$search = $filter['search'];

			$this->db->group_start();

			$this->db->like('ka_name', $search);
			$this->db->or_like('en_name', $search);
			$this->db->or_like('ru_name', $search);
			$this->db->or_like('ka_description', $search);
			$this->db->or_like('en_description', $search);
			$this->db->or_like('ru_description', $search);
			$this->db->or_like('brand', $search);
			
			$this->db->group_end();
		}

		if(!empty($filter['for_sale'])) {

			$this->db->where('for_sale', 1);
		}
	}

}

/* End of file Product.php */
/* Location: ./application/models/Product.php */
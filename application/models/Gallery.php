<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends MY_Model {

	protected $table = 'gallery';

	public function get_for_product($product) {

		$this->db->where('product', $product);

		return $this->get_list();
	}

	public function delete($id) {

		$img = $this->get($id);
		$path = 'static/uploads/products/';

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

/* End of file Gallery.php */
/* Location: ./application/models/Gallery.php */
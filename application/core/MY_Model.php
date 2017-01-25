<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	protected $table;

	public function get($id) {

		$this->db->where($this->table.'.id', $id);

		$r = $this->db->get($this->table);

		return $r->row();
	}

	public function add($data) {

		return $this->db->insert($this->table, $data);
	}

	public function edit($data) {

		$this->db->where('id', $data['id']);

		return $this->db->update($this->table, $data);
	}

	public function delete($id) {

		$this->db->where('id', $id);

		return $this->db->delete($this->table);
	}

	public function get_list($limit = NULL, $offset = NULL) {

		if($limit) {
			if($offset) {
				$this->db->limit($limit, $offset);
			}

			else {
				$this->db->limit($limit);
			}
		}

		$r = $this->db->get($this->table);

		return $r->result();
	}

	public function get_by_key($key, $value) {

		$this->db->where($key, $value);

		$r = $this->db->get($this->table);

		return $r->row();
	}

	protected function generate_slug($raw, $key = 'slug') {

		$i = 0;

		do {

			$slug = url_title($raw);

			if($i) {
				$slug .= $i;
			}

			$this->db->where($key, $slug);
			$r = $this->db->get($this->table);

			$i++;

		} while($r->num_rows());

		return $slug;
	}

}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */
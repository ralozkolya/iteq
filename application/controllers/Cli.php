<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cli extends CI_Controller {

	public function close_day() {

		$this->load->library('Payment');
		$this->payment->close_day();
		$this->load->model('Order');
		$this->Order->update_recents();

		echo 'TBC Bank day last closed at: ' . date('Y-m-d H:i:s', strtotime('now')) . "\n";
	}

}

/* End of file Cli.php */
/* Location: ./application/controllers/Cli.php */
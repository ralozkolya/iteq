<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function send_order($email) {

	$ci =& get_instance();

	$data['email'] = $email;
	$data['subject'] = lang('order_placed');
	$data['message'] = $ci->load->view('email/order_placed', NULL, TRUE);

	send_email($data);

	$data['email'] = SHOP_MAIL;
	$data['subject'] = 'Order received';
	$data['message'] = $ci->load->view('email/order_received', NULL, TRUE);

	send_email($data);
}

function send_recovery($user) {

	$ci =& get_instance();

	$token = $ci->User->get_token();

	$ci->User->edit(array(
		'id' => $user->id,
		'token' => $token,
	));

	$data['email'] = $user->email;
	$data['subject'] = lang('password_recovery');
	$data['message'] = $ci->load->view('email/password_recovery', array(
		'token' => $token,
		'user' => $user,
	), TRUE);

	send_email($data);
}

function send_message($d) {

	$ci =& get_instance();

	$data['email'] = INFO_MAIL;
	$data['subject'] = 'Message received on Iteq.ge';
	$data['message'] = $ci->load->view('email/message_received', $d, TRUE);
	$data['reply_to'] = $d['email'];

	send_email($data);
}

function send_email($data) {

	$ci =& get_instance();

	$ci->config->load('email');

	$config = $ci->config->item('email');

	$ci->load->library('email', $config);

	$ci->email->from($config["smtp_user"], "No-Reply");
	$ci->email->to($data['email']);

	if(!empty($data['reply_to'])) {
		$ci->email->reply_to($data['reply_to'], $data['name']);
	}

	$ci->email->subject($data['subject']);
	$ci->email->message($data['message']);

	$ci->email->send();
}

/* End of file email_sender_helper.php */
/* Location: ./application/helpers/email_sender_helper.php */
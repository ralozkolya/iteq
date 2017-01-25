<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function set_language() {

	$ci =& get_instance();

	$lang = $ci->uri->segment(1);
	$config = $ci->config->item('language');
	$cookie = json_decode(base64_decode(get_cookie('lang')));

	if(!$cookie || !isset($cookie->value)) {
		$cookie = new stdClass;
		$cookie->value = $config;
		$cookie->expire = 0;
	}

	if($lang !== EN && $lang !== GE && $lang !== RU) {
		if($cookie->value === EN || $cookie->value === GE || $cookie->value === RU) {
			$lang = $cookie->value;
		}

		else {
			$lang = $config;
		}
	}

	if($config !== $lang) {
		$ci->config->set_item('language', $lang);
	}

	$diff = $cookie->expire - strtotime('now');

	$diff = $diff / 60 / 60 / 24;

	if($diff < 45 || $cookie->value !== $lang) { //if it's been around 2 weeks

		$cookie = array(
			'value' => $lang,
			'expire' => strtotime('2 months'),
		);

		$value = base64_encode(json_encode($cookie));

		set_cookie(array(
			'name' => 'lang',
			'value' => $value,
			'expire' => 60*60*24*60,
		));
	}

	$ci->load->language('general');
}

function lang_link($lang) {

	$ci =& get_instance();

	$uri = $ci->uri->uri_string();

	if (count($_GET) > 0) {
		$uri  .= '?' . http_build_query($_GET, '', "&");
	}

	$link = preg_replace('/'.GE.'|'.EN.'|'.RU.'/', $lang, $uri, 1);

	if(!$link) $link = $lang;

	return base_url().$link;
}

function get_lang() {
	
	$ci =& get_instance();

	return $ci->config->item('language');
}

function get_lang_code($lang) {
	switch($lang) {
		case EN: return 'en';
		case GE: return 'ka';
		case RU: return 'ru';
	}
}
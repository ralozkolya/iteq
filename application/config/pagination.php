<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['pagination']['num_links'] = 3;
$config['pagination']['use_page_numbers'] = TRUE;
$config['pagination']['full_tag_open'] = '<ul class="pagination">';
$config['pagination']['full_tag_close'] = '</ul>';
$config['pagination']['first_link'] = lang('first');
$config['pagination']['first_tag_open'] = '<li>';
$config['pagination']['first_tag_close'] = '</li>';
$config['pagination']['last_link'] = lang('last');
$config['pagination']['last_tag_open'] = '<li>';
$config['pagination']['last_tag_close'] = '</li>';
$config['pagination']['next_link'] = '&raquo;';
$config['pagination']['next_tag_open'] = '<li>';
$config['pagination']['next_tag_close'] = '</li>';
$config['pagination']['prev_link'] = '&laquo;';
$config['pagination']['prev_tag_open'] = '<li>';
$config['pagination']['prev_tag_close'] = '</li>';
$config['pagination']['cur_tag_open'] = '<li class="active"><span>';
$config['pagination']['cur_tag_close'] = '</span></li>';
$config['pagination']['num_tag_open'] = '<li>';
$config['pagination']['num_tag_close'] = '</li>';
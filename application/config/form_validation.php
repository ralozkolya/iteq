<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['register'] = array(

	array(
		'field' => 'first_name',
		'label' => 'lang:first_name',
		'rules' => 'required|trim',
	),

	array(
		'field' => 'last_name',
		'label' => 'lang:last_name',
		'rules' => 'required|trim',
	),

	array(
		'field' => 'personal_number',
		'label' => 'lang:personal_number',
		'rules' => 'required|trim|numeric',
	),

	array(
		'field' => 'email',
		'label' => 'lang:email',
		'rules' => 'required|trim|valid_email|is_unique[users.email]',
	),

	array(
		'field' => 'phone',
		'label' => 'lang:phone',
		'rules' => 'required|trim|is_unique[users.phone]',
	),

	array(
		'field' => 'password',
		'label' => 'lang:password',
		'rules' => 'required|min_length[6]',
	),

	array(
		'field' => 'repeat_password',
		'label' => 'lang:repeat_password',
		'rules' => 'required|matches[password]',
	),
);

$config['send_message'] = array(

	array(
		'field' => 'name',
		'label' => 'lang:name',
		'rules' => 'required|trim',
	),

	array(
		'field' => 'email',
		'label' => 'lang:email',
		'rules' => 'required|trim|valid_email',
	),

	array(
		'field' => 'message',
		'label' => 'lang:message',
		'rules' => 'required|trim',
	),
);

$config['add_Category'] = array(
	array(
		'field' => 'ka_name',
		'label' => 'lang:ka_name',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'en_name',
		'label' => 'lang:en_name',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'ru_name',
		'label' => 'lang:ru_name',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'parent',
		'label' => 'lang:parent',
		'rules' => 'required|is_natural',
	),
);

$config['edit_Category'] = array(
	array(
		'field' => 'id',
		'label' => 'lang:id',
		'rules' => 'required|is_natural',
	),
	array(
		'field' => 'ka_name',
		'label' => 'lang:ka_name',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'en_name',
		'label' => 'lang:en_name',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'ru_name',
		'label' => 'lang:ru_name',
		'rules' => 'required|trim',
	),
);

$config['edit_Page'] = array(
	array(
		'field' => 'id',
		'label' => 'lang:id',
		'rules' => 'required|is_natural',
	),
	array(
		'field' => 'ka_title',
		'label' => 'lang:ka_title',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'en_title',
		'label' => 'lang:en_title',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'ru_title',
		'label' => 'lang:ru_title',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'priority',
		'label' => 'lang:priority',
		'rules' => 'required|is_natural',
	),
);

$config['add_Product'] = array(
	array(
		'field' => 'ka_name',
		'label' => 'lang:ka_name',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'en_name',
		'label' => 'lang:en_name',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'ru_name',
		'label' => 'lang:ru_name',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'price',
		'label' => 'lang:price',
		'rules' => 'numeric',
	),
	array(
		'field' => 'in_stock',
		'label' => 'lang:in_stock',
		'rules' => 'numeric',
	),
	array(
		'field' => 'for_sale',
		'label' => 'lang:for_sale',
		'rules' => 'numeric',
	),
	array(
		'field' => 'category',
		'label' => 'lang:category',
		'rules' => 'required|is_natural',
	),
);

$config['edit_Product'] = array(
	array(
		'field' => 'id',
		'label' => 'lang:id',
		'rules' => 'required|is_natural',
	),
	array(
		'field' => 'ka_name',
		'label' => 'lang:ka_name',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'en_name',
		'label' => 'lang:en_name',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'ru_name',
		'label' => 'lang:ru_name',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'price',
		'label' => 'lang:price',
		'rules' => 'numeric',
	),
	array(
		'field' => 'in_stock',
		'label' => 'lang:in_stock',
		'rules' => 'numeric',
	),
	array(
		'field' => 'for_sale',
		'label' => 'lang:for_sale',
		'rules' => 'numeric',
	),
	array(
		'field' => 'category',
		'label' => 'lang:category',
		'rules' => 'required|is_natural',
	),
);

$config['add_images'] = array(
	array(
		'field' => 'product',
		'label' => 'lang:product',
		'rules' => 'required|is_natural',
	),
);

$config['add_address'] = array(
	array(
		'field' => 'address',
		'label' => 'lang:address',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'city',
		'label' => 'lang:city',
		'rules' => 'required|trim',
	),
	array(
		'field' => 'zip_code',
		'label' => 'lang:zip_code',
		'rules' => 'numeric',
	),
);

$config['change_profile'] = array(

	array(
		'field' => 'first_name',
		'label' => 'lang:first_name',
		'rules' => 'required|trim',
	),

	array(
		'field' => 'last_name',
		'label' => 'lang:last_name',
		'rules' => 'required|trim',
	),

	array(
		'field' => 'personal_number',
		'label' => 'lang:personal_number',
		'rules' => 'required|trim|numeric',
	),

	array(
		'field' => 'email',
		'label' => 'lang:email',
		'rules' => 'required|trim|valid_email',
	),

	array(
		'field' => 'phone',
		'label' => 'lang:phone',
		'rules' => 'required|trim',
	),
);

$config['change_password'] = array(

	array(
		'field' => 'password',
		'label' => 'lang:password',
		'rules' => 'required|min_length[6]',
	),

	array(
		'field' => 'repeat_password',
		'label' => 'lang:repeat_password',
		'rules' => 'required|matches[password]',
	),
);

$config['add_Banner'] = array(

	array(
		'field' => 'priority',
		'label' => 'lang:priority',
		'rules' => 'numeric',
	),
);

$config['edit_Banner'] = array(

	array(
		'field' => 'id',
		'label' => 'lang:id',
		'rules' => 'required|numeric',
	),

	array(
		'field' => 'priority',
		'label' => 'lang:priority',
		'rules' => 'numeric',
	),
);

$config['add_Pinned_link'] = array(

	array(
		'field' => 'en_description',
		'label' => 'lang:en_description',
		'rules' => 'required',
	),

	array(
		'field' => 'ka_description',
		'label' => 'lang:ka_description',
		'rules' => 'required',
	),

	array(
		'field' => 'ru_description',
		'label' => 'lang:ru_description',
		'rules' => 'required',
	),

	array(
		'field' => 'priority',
		'label' => 'lang:priority',
		'rules' => 'numeric',
	),
);

$config['edit_Pinned_link'] = array(

	array(
		'field' => 'id',
		'label' => 'lang:id',
		'rules' => 'required|is_natural',
	),

	array(
		'field' => 'en_description',
		'label' => 'lang:en_description',
		'rules' => 'required',
	),

	array(
		'field' => 'ka_description',
		'label' => 'lang:ka_description',
		'rules' => 'required',
	),

	array(
		'field' => 'ru_description',
		'label' => 'lang:ru_description',
		'rules' => 'required',
	),

	array(
		'field' => 'priority',
		'label' => 'lang:priority',
		'rules' => 'numeric',
	),
);

$config['add_Brand'] = array(

	array(
		'field' => 'en_name',
		'label' => 'lang:en_name',
		'rules' => 'required',
	),

	array(
		'field' => 'ka_name',
		'label' => 'lang:ka_name',
		'rules' => 'required',
	),

	array(
		'field' => 'ru_name',
		'label' => 'lang:ru_name',
		'rules' => 'required',
	),

	array(
		'field' => 'priority',
		'label' => 'lang:priority',
		'rules' => 'numeric',
	),
);

$config['edit_Brand'] = array(

	array(
		'field' => 'id',
		'label' => 'lang:id',
		'rules' => 'required|is_natural',
	),

	array(
		'field' => 'en_name',
		'label' => 'lang:en_name',
		'rules' => 'required',
	),

	array(
		'field' => 'ka_name',
		'label' => 'lang:ka_name',
		'rules' => 'required',
	),

	array(
		'field' => 'ru_name',
		'label' => 'lang:ru_name',
		'rules' => 'required',
	),

	array(
		'field' => 'priority',
		'label' => 'lang:priority',
		'rules' => 'numeric',
	),
);
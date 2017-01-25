<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$lang = '('.GE.'|'.EN.'|'.RU.')';

$route[$lang.'/products/(:num)'] = 'site/products/$2';
$route[$lang.'/shop/(:num)'] = 'site/shop/$2';
$route[$lang.'/product/(:num)/(:any)'] = 'site/product/$2/$3';

$route[$lang.'/profile'] = 'profile';
$route[$lang.'/profile/(:any)'] = 'profile/$2';

$route[$lang] = 'site';
$route[$lang.'/(:any)'] = 'site/$2';

$route[$lang.'/order/(:num)'] = 'profile/order/$2';

$route['send_message'] = 'site/send_message';
$route['add_to_cart/(:num)'] = 'site/add_to_cart/$1';
$route['add_to_cart/(:num)/(:num)'] = 'site/add_to_cart/$1/$2';
$route['clear_cart'] = 'site/clear_cart';
$route['delete_from_cart/(:num)'] = 'site/delete_from_cart/$1';
$route['add_address'] = 'profile/add_address';
$route['logout'] = 'site/logout';
$route['transactions_status/(:any)'] = 'site/transactions_status/$1';
$route['sitemap.xml'] = 'site/sitemap';

$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

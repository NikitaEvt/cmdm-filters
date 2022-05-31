<?php
defined('BASEPATH') or exit('No direct script access allowed');

$langs_array = array('ru', 'ro');
$langs = '(' . implode('|', $langs_array) . ')';

$route['default_controller'] = 'pages';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Import */
$route['import/categories'] = "import/import";
$route['import/products'] = "import/products";
$route['import/categories'] = "import/categories";
$route['import/products_cat'] = "import/products_cat";
/* END Import */

/* Ajax */

/* END Ajax */

/* Frontend */
$route[$langs] = "pages/index";
$route[$langs . '/(katalog|catalog)'] = "frontend/catalog/index";
$route[$langs . '/catalog/item'] = "frontend/catalog/item";
$route[$langs . '/(korzina|cos)'] = "frontend/cart/index";
$route[$langs . '/cart/order'] = "frontend/cart/cartOrder";
/* END Frontend */

/* Default Routing */
$route[$langs . '/:any/:any/:any/:any/:any'] = 'pages/text_pages';
$route[$langs . '/:any/:any/:any/:any'] = 'pages/text_pages';
$route[$langs . '/:any/:any/:any'] = 'pages/text_pages';
$route[$langs . '/:any/:any'] = 'pages/text_pages';
$route[$langs . '/:any'] = 'pages/text_pages';


/* Dashboard */
$route['backend_features/(:any)'] = "features/$1";
$route['backend'] = "backend/auth/login";
$route['backend/login'] = "backend/auth/login";
$route['backend/logout'] = "backend/auth/logout";
$route['backend/delete_photo'] = "backend/dashboard/delete_photo";
$route['backend/delete_img_row'] = "backend/dashboard/delete_img_row";
$route['backend/delete_file'] = "backend/dashboard/delete_file";
$route['backend/change_select'] = "backend/dashboard/change_select";
$route['backend/change_check'] = "backend/dashboard/change_check";
$route['backend/change_check_firebase'] = "backend/dashboard/change_check_firebase";

$route['backend/(:any)'] = "backend/$1";
$route['backend/(:any)/(:any)'] = "backend/$1/$2";
$route['backend/(:any)/(:any)/(:any)'] = "backend/$1/$2/$3";
$route['backend/(:any)/(:any)/(:any)/(:any)'] = "backend/$1/$2/$3/$4";
$route['backend/(:any)/(:any)/(:any)/(:any)/(:any)'] = "backend/$1/$2/$3/$4/$5";

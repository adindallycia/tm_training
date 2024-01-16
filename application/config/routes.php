<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'login/index';
$route['register'] = 'register/index';
$route['dashboard'] = 'dashboard/index';
$route['logout'] = 'logout/index';

$route['jenis_obat'] = 'jenis_obat/index';
$route['jenis_obat/proses_tambah'] = 'jenis_obat/proses_tambah';
$route['jenis_obat/edit/(:num)'] = 'jenis_obat/edit/$1';
$route['jenis_obat/hapus/(:num)'] = 'jenis_obat/hapus/$1';
$route['jenis_obat/proses_edit'] = 'jenis_obat/proses_edit';

$route['obat'] = 'obat';
$route['obat/proses_tambah'] = 'obat/proses_tambah';
$route['obat/edit/(:any)'] = 'obat/edit/$1';
$route['obat/proses_edit'] = 'obat/proses_edit';
$route['obat/hapus/(:any)'] = 'obat/hapus/$1';
$route['users'] = 'user/index';
$route['users/proses_tambah'] = 'user/proses_tambah';
$route['users/edit/(:num)'] = 'user/edit/$1';
$route['users/hapus/(:num)'] = 'user/hapus/$1';
$route['users/proses_edit'] = 'user/proses_edit';

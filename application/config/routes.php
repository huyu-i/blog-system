<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login/create'] = 'login/create';
$route['login/log_in'] = 'login/log_in';
$route['login/(:any)'] = 'login/log_in/$1';
$route['login'] = 'login';

$route['BS_User/uRegister'] = 'BS_User/uRegister';
$route['BS_User/index'] = 'BS_User/index';
$route['BS_User/log_in'] = 'BS_User/log_in';
$route['BS_User/(:any)'] = 'BS_User/log_in/$1';
$route['BS_User'] = 'BS_User';

$route['BS_Blog/getByUid'] = 'BS_Blog/getByUid';
$route['BS_Blog/writeLoad'] = 'BS_Blog/writeLoad';
$route['BS_Blog/modifyLoad'] = 'BS_Blog/modifyLoad';

$route['RedisController/redis_login'] = 'RedisController/redis_login';
$route['RedisController/redis_insertAsSet'] = 'RedisController/redis_insertAsSet';
$route['RedisController/redis_insertAsHash'] = 'RedisController/redis_insertAsHash';

$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';

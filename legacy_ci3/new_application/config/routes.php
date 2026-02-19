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
$route['default_controller'] = 'front/home';
$route['admin'] = 'admin/user/index';
$route['login'] = 'front/login';
$route['logout'] = 'front/userLogout';
$route['unsubscribe'] = 'front/unsubscribe';
$route['register'] = 'front/index';
$route['dashboard'] = 'front/dashboard';
$route['proof_of_purchase'] = 'front/proof_of_purchase';
$route['proof_of_cover_purchase'] = 'front/proof_of_cover_purchase';
$route['offre-robot'] = 'front/proof_of_purchase';
$route['offre-cover'] = 'front/proof_of_cover_purchase';
$route['draw'] = 'front/draw';
$route['gpcastellet'] = 'front/draw';

$route['contrat-dexcellence'] = 'front/refund';
$route['refund'] = 'front/refund';
$route['support'] = 'front/support';
$route['forgotpassword'] = 'front/forgotpassword';
$route['modifier-mon-profil'] = 'front/editprofile';

$route['jeu'] = 'front/jeu';

$route['page/(:any)'] = 'page/index';
$route['politique-cookies'] = 'page/index';

$route['thankyou_op1'] = 'front/thankyou_op1';
$route['thankyou_op2'] = 'front/thankyou_op2';
$route['thankyou_op3'] = 'front/thankyou_op3';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

 
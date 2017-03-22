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

$route['default_controller'] = 'Bumper';
$route['404_override'] 	= '';
$route['translate_uri_dashes'] = FALSE;


// ROUTE COMPRO
$route['komunitas'] = 'masuk';
$route['main'] 		= 'home';
$route['services'] 	= 'home/services';
$route['faq'] 		= 'home/faq';
$route['contact'] 	= 'home/contact';
$route['partners'] 	= 'home/partners';
$route['about'] 	= 'home/aboutus';
$route['agenda'] 	= 'home/agenda_home';


$route['komunitas'] = 'home/list_kom';
$route['koperasi'] = 'home/list_kop';
$route['jenis_koperasi/(:any)'] = "home/list_kop_jenis";
$route['detail_koperasi/(:any)'] = "home/detail_koperasi";
$route['koperasi/(:any)/(:any)'] = 'home/view_kop_berita';
$route['koperasi/(:any)/(:any)/berita'] = 'home/view_kop_berita';
$route['koperasi/(:any)/(:any)/berita/(:num)/(:any)'] = 'home/view_kop_berita_detail';
$route['koperasi/(:any)/(:any)/agenda'] = 'home/view_kop_agenda';
$route['koperasi/(:any)/(:any)/agenda/(:num)/(:any)'] = 'home/view_kop_agenda_detail';
$route['koperasi/(:any)/(:any)/event'] = 'home/view_kop_event';
$route['koperasi/(:any)/(:any)/event/(:num)/(:any)'] = 'home/view_kop_event_detail';
$route['koperasi/(:any)/(:any)/info'] = 'home/view_kop_info';



$route['agenda/(:any)'] = 'home/agenda_detail';
$route['news'] 			= 'home/news';
$route['emag'] 			= 'home/emag';
$route['emag/(:any)'] 	= 'home/emag_detail';
$route['news/(:any)'] 	= 'home/news_detail';
$route['event/(:any)'] 	= 'home/event_detail';

$route['agenda9'] 	= 'home/agenda';
$route['agenda10'] 	= 'home/agenda';
$route['agenda11'] 	= 'home/agenda';
$route['agenda12'] 	= 'home/agenda';
$route['agenda13'] 	= 'home/agenda';



// ROUTE STORE
$route['belanja'] = 'store/l';

$route['coming_soon'] = 'soon';



// ROUTE GERAI
$route['geraimuslim'] = 'gerai/gerai_main';
$route['gerai'] 	  = 'gerai/gerai_main';



// ROUTE AUTH
$route['masuk']  = 'auth/login';
$route['attemp'] = 'auth/login_p';
$route['daftar'] = 'auth/register';
$route['recovery'] = 'Forgot_password/recovery';
$route['reset_password/(:any)'] = 'Forgot_password/reset_password/$1';
$route['reset_password'] = 'Forgot_password/reset_password';


// RESTRICTED (GAK BOLEH DIUBAH)
$route['datacellcom/refund'] = 'datacell/retrieve_refund';
$route['datacellcom/notif'] = 'datacell/retrieve_notif';
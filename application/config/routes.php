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
$route['default_controller'] = 'home';
$route['404_override'] = 'errors/page_missing';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| CUSTOM ROUTES - FRONTEND
| -------------------------------------------------------------------------
*/

// Frontend Program Studi Routes
$route['program-studi'] = 'program_studi/index';
$route['program-studi/cari'] = 'program_studi/search';
$route['program-studi/jenjang/(:any)'] = 'program_studi/jenjang/$1';
$route['program-studi/unggulan'] = 'program_studi/unggulan';
$route['program-studi/ajax-get-programs'] = 'program_studi/ajax_get_programs';
$route['program-studi/(:any)'] = 'program_studi/detail/$1';

// News Routes (Frontend)
$route['news'] = 'news/index';
$route['news/page/(:num)'] = 'news/index/$1';
$route['news/search'] = 'news/search';
$route['news/category/(:any)'] = 'news/category/$1';
$route['news/category/(:any)/(:num)'] = 'news/category/$1/$2';
$route['news/(:any)'] = 'news/detail/$1';

// Facilities Routes (Frontend)
$route['facilities'] = 'facilities/index';
$route['facilities/page/(:num)'] = 'facilities/index/$1';
$route['facilities/search'] = 'facilities/search';
$route['facilities/category/(:any)'] = 'facilities/category/$1';
$route['facilities/category/(:any)/(:num)'] = 'facilities/category/$1/$2';
$route['facilities/detail/(:any)'] = 'facilities/detail/$1';

// API Routes for Facilities
$route['api/facilities/latest'] = 'facilities/get_latest_facilities';
$route['api/facilities/latest/(:num)'] = 'facilities/get_latest_facilities/$1';
$route['api/facilities/featured'] = 'facilities/get_featured_facilities';
$route['api/facilities/featured/(:num)'] = 'facilities/get_featured_facilities/$1';
$route['api/facilities/category/(:num)'] = 'facilities/get_facilities_by_category/$1';
$route['api/facilities/category/(:num)/(:num)'] = 'facilities/get_facilities_by_category/$1/$2';
$route['api/facilities/stats'] = 'facilities/get_stats';

// API Routes for News
$route['api/news/latest'] = 'news/get_latest_news';
$route['api/news/latest/(:num)'] = 'news/get_latest_news/$1';
$route['api/news/featured'] = 'news/get_featured_news';
$route['api/news/featured/(:num)'] = 'news/get_featured_news/$1';
$route['api/news/popular'] = 'news/get_popular_news';
$route['api/news/popular/(:num)'] = 'news/get_popular_news/$1';
$route['api/news/widget/(:any)'] = 'news/widget/$1';
$route['api/news/widget/(:any)/(:num)'] = 'news/widget/$1/$2';
$route['api/news/category/(:num)'] = 'news/get_news_by_category/$1';
$route['api/news/category/(:num)/(:num)'] = 'news/get_news_by_category/$1/$2';
$route['api/news/stats'] = 'news/get_stats';

// Academic Routes (Frontend)
$route['akademik/(:any)'] = 'akademik/index/$1';
$route['akademik'] = 'akademik';

// Kemahasiswaan Routes (Frontend)
$route['kemahasiswaan/(:any)'] = 'kemahasiswaan/index/$1';
$route['kemahasiswaan'] = 'kemahasiswaan';

// Tentang Routes (Frontend)
$route['tentang/(:any)'] = 'tentang/index/$1';
$route['tentang'] = 'tentang';

// SDM Routes (Frontend)
$route['sdm'] = 'sdm/index';
$route['sdm/detail-dosen/(:num)'] = 'sdm/detail_dosen/$1';
$route['sdm/detail-staf/(:num)'] = 'sdm/detail_staf/$1';
$route['sdm/ajax/dosen-by-prodi'] = 'sdm/get_dosen_by_prodi';
$route['sdm/ajax/staf-by-divisi'] = 'sdm/get_staf_by_divisi';

// Menu System Routes (Frontend)
$route['page/(:any)'] = 'pages/show/$1';
$route['category/(:any)'] = 'pages/category/$1';
$route['search'] = 'pages/search';

// Other Frontend Routes
$route['tentang'] = 'pages/about';
$route['kontak'] = 'pages/contact';
$route['faq'] = 'pages/faq';
$route['pendaftaran'] = 'pages/registration';
$route['konsultasi'] = 'pages/consultation';
$route['privacy-policy'] = 'pages/privacy';
$route['terms-of-service'] = 'pages/terms';
$route['sitemap'] = 'pages/sitemap';

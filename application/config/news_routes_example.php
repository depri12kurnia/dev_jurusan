<?php

/**
 * Add these routes to your application/config/routes.php file
 * for SEO-friendly news URLs
 */

// News routes
$route['news'] = 'news/index';
$route['news/page/(:num)'] = 'news/index/$1';
$route['news/(:any)'] = 'news/detail/$1';
$route['news/category/(:any)'] = 'news/category/$1';
$route['news/category/(:any)/(:num)'] = 'news/category/$1/$2';
$route['news/search'] = 'news/search';

// API routes for AJAX calls
$route['api/news/latest'] = 'news/get_latest_news';
$route['api/news/latest/(:num)'] = 'news/get_latest_news/$1';
$route['api/news/featured'] = 'news/get_featured_news';
$route['api/news/featured/(:num)'] = 'news/get_featured_news/$1';
$route['api/news/widget/(:any)'] = 'news/widget/$1';
$route['api/news/widget/(:any)/(:num)'] = 'news/widget/$1/$2';
$route['api/news/category/(:num)'] = 'news/get_news_by_category/$1';
$route['api/news/category/(:num)/(:num)'] = 'news/get_news_by_category/$1/$2';
$route['api/news/stats'] = 'news/get_stats';

/*
 * Example URLs after adding these routes:
 * 
 * - <?= site_url('news') ?> → News list page
 * - <?= site_url('news/berita-terbaru-kampus') ?> → News detail
 * - <?= site_url('news/category/akademik') ?> → News by category
 * - <?= site_url('api/news/latest/6') ?> → Get 6 latest news (JSON)
 * - <?= site_url('api/news/widget/featured/3') ?> → Get 3 featured news (JSON)
 */

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default / home page
$routes->get('/', 'Front::home');

// Auth routes
$routes->get('login', 'Front::login');
$routes->post('checkLogin', 'Front::checkLogin');
$routes->get('logout', 'Front::userLogout');
$routes->get('register', 'Front::index');
$routes->post('createprofile', 'Front::createprofile');
$routes->get('forgotpassword', 'Front::forgotpassword');
$routes->post('check_email', 'Front::check_email');
$routes->get('resetpassword', 'Front::resetpassword');
$routes->post('UpdatePassword', 'Front::UpdatePassword');

// Dashboard
$routes->get('dashboard', 'Front::dashboard');

// Profile
$routes->get('modifier-mon-profil', 'Front::editprofile');
$routes->post('updateprofile', 'Front::updateprofile');

// Proof of Purchase / Robot Offer
$routes->get('proof_of_purchase', 'Front::proof_of_purchase');
$routes->get('offre-robot', 'Front::proof_of_purchase');
$routes->post('create_proof_of_purchase_new', 'Front::create_proof_of_purchase_new');

// Draw
$routes->get('draw', 'Front::draw');
$routes->get('poolposition', 'Front::draw');
$routes->get('gpitalie', 'Front::draw');
$routes->post('create_draw', 'Front::create_draw');

// Refund / Contract
$routes->get('contrat-dexcellence', 'Front::refund');
$routes->get('refund', 'Front::refund');
$routes->post('create_refundnew', 'Front::create_refundnew');

// Support
$routes->get('support', 'Front::support');
$routes->post('create_support', 'Front::create_support');

// Unsubscribe
$routes->get('unsubscribe', 'Front::unsubscribe');
$routes->post('check_unsubcribe', 'Front::check_unsubcribe');

// Thank You pages
$routes->get('thankyou_robot', 'Front::thankyou_op1');
$routes->get('thankyou_draw', 'Front::thankyou_op2');
$routes->get('thankyou_op3', 'Front::thankyou_op3');

// Cron jobs
$routes->get('cron-proof', 'Front::cron_proof');
$routes->get('cron-draw', 'Front::cron_draw');

// AJAX endpoints
$routes->post('get_country_store', 'Front::get_country_store');
$routes->post('get_country_store_handle', 'Front::get_country_store_handle');
$routes->post('get_country_robot_store_handle', 'Front::get_country_robot_store_handle');

// Legacy front/ routes
$routes->group('front', static function($routes) {
    $routes->post('get_country_robot_store_handle', 'Front::get_country_robot_store_handle');
    $routes->post('get_country_store', 'Front::get_country_store');
    $routes->post('get_country_store_handle', 'Front::get_country_store_handle');
    $routes->get('login', 'Front::login');
    $routes->get('logout', 'Front::userLogout');
    $routes->get('register', 'Front::index');
    $routes->get('forgotpassword', 'Front::forgotpassword');
    $routes->get('resetpassword', 'Front::resetpassword');
    $routes->post('check_email', 'Front::check_email');
    $routes->post('UpdatePassword', 'Front::UpdatePassword');
    $routes->post('create_proof_of_purchase_new', 'Front::create_proof_of_purchase_new');
    $routes->post('check_unsubcribe', 'Front::check_unsubcribe');
    $routes->post('updateprofile', 'Front::updateprofile');
    $routes->post('create_draw', 'Front::create_draw');
    $routes->post('createprofile', 'Front::createprofile');
    $routes->post('create_refundnew', 'Front::create_refundnew');
    $routes->post('checkLogin', 'Front::checkLogin');
    $routes->post('create_support', 'Front::create_support');
});

// Mail test
$routes->get('send_mail', 'Front::sendMail');

// Jeu (game)
$routes->get('jeu', 'Front::jeu');

// Page routes
$routes->get('page/(:any)', 'Page::index');
$routes->get('politique-cookies', 'Page::index');

// Admin
$routes->get('admin', 'Admin\User::index');
$routes->match(['GET', 'POST'], 'admin/user/checklogin', 'Admin\User::checklogin');
$routes->get('admin/logout', 'Admin\User::logout');
$routes->get('admin/dashboard', 'Admin\Dashboard::index');

// Admin User Management
$routes->get('admin/user/Viewuser', 'Admin\User::Viewuser');
$routes->get('admin/user/Adduser', 'Admin\User::Adduser');
$routes->post('admin/user/createprofile', 'Admin\User::createprofile');
$routes->get('admin/user/viewprofile/(:num)', 'Admin\User::viewprofile/$1');
$routes->get('admin/user/editprofile/(:num)', 'Admin\User::editprofile/$1');
$routes->post('admin/user/updateprofile/(:num)', 'Admin\User::updateprofile/$1');
$routes->get('admin/user/removeprofile/(:num)', 'Admin\User::removeprofile/$1');
$routes->post('admin/user/UploadImportFile', 'Admin\User::UploadImportFile');


// Admin Block Management
$routes->get('admin/block/Viewblock', 'Admin\\Block::Viewblock');
$routes->get('admin/block/Addblock', 'Admin\\Block::Addblock');
$routes->post('admin/block/createblock', 'Admin\\Block::createblock');
$routes->get('admin/block/editblock/(:num)', 'Admin\\Block::editblock/$1');
$routes->post('admin/block/updateblock/(:num)', 'Admin\\Block::updateblock/$1');
$routes->get('admin/block/removeblock/(:num)', 'Admin\\Block::removeblock/$1');

// Admin Robot Management
$routes->get('admin/robot/Viewrobot', 'Admin\\Robot::Viewrobot');
$routes->get('admin/robot/Addrobot', 'Admin\\Robot::Addrobot');
$routes->post('admin/robot/create', 'Admin\\Robot::create');
$routes->get('admin/robot/edit/(:num)', 'Admin\\Robot::edit/$1');
$routes->post('admin/robot/update/(:num)', 'Admin\\Robot::update/$1');
$routes->get('admin/robot/remove/(:num)', 'Admin\\Robot::remove/$1');

// Admin Store Management
$routes->get('admin/store/Viewstore', 'Admin\\Store::Viewstore');
$routes->get('admin/store/Addstore', 'Admin\\Store::Addstore');
$routes->post('admin/store/create', 'Admin\\Store::create');
$routes->get('admin/store/edit/(:num)', 'Admin\\Store::edit/$1');
$routes->post('admin/store/update/(:num)', 'Admin\\Store::update/$1');
$routes->get('admin/store/remove/(:num)', 'Admin\\Store::remove/$1');

// Admin Coupon Management
$routes->get('admin/coupon/Viewcoupon', 'Admin\\Coupon::Viewcoupon');
$routes->get('admin/coupon/Addcoupon', 'Admin\\Coupon::Addcoupon');
$routes->post('admin/coupon/create', 'Admin\\Coupon::create');
$routes->get('admin/coupon/edit/(:num)', 'Admin\\Coupon::edit/$1');
$routes->post('admin/coupon/update/(:num)', 'Admin\\Coupon::update/$1');
$routes->get('admin/coupon/remove/(:num)', 'Admin\\Coupon::remove/$1');

// Admin Robot Store Management
$routes->get('admin/storerobot/Viewstore', 'Admin\\Storerobot::Viewstore');
$routes->get('admin/storerobot/Addstore', 'Admin\\Storerobot::Addstore');
$routes->post('admin/storerobot/create', 'Admin\\Storerobot::create');
$routes->get('admin/storerobot/edit/(:num)', 'Admin\\Storerobot::edit/$1');
$routes->post('admin/storerobot/update/(:num)', 'Admin\\Storerobot::update/$1');
$routes->get('admin/storerobot/remove/(:num)', 'Admin\\Storerobot::remove/$1');

// Admin Mail Template Management
$routes->get('admin/template/Viewtemplate', 'Admin\\Template::Viewtemplate');
$routes->get('admin/template/Addtemplate', 'Admin\\Template::Addtemplate');
$routes->post('admin/template/create', 'Admin\\Template::create');
$routes->get('admin/template/edit/(:num)', 'Admin\\Template::edit/$1');
$routes->post('admin/template/update/(:num)', 'Admin\\Template::update/$1');
$routes->get('admin/template/remove/(:num)', 'Admin\\Template::remove/$1');

// Admin Menu Management
$routes->match(['GET', 'POST'], 'admin/menu/Viewmenu', 'Admin\\Menu::Viewmenu');
$routes->post('admin/menu/savemenu', 'Admin\\Menu::savemenu');
$routes->get('admin/menu/removemenu/(:num)', 'Admin\\Menu::removemenu/$1');

// Admin Proof (Offer Robot)
$routes->get('admin/proof', 'Admin\\Proof::index');
$routes->get('admin/proof/edit/(:num)', 'Admin\\Proof::edit/$1');
$routes->post('admin/proof/newupdate', 'Admin\\Proof::newupdate');
$routes->get('admin/proof/remove/(:num)', 'Admin\\Proof::remove/$1');

// Admin Draw (Concours GP Italie)
$routes->get('admin/draw', 'Admin\\Draw::index');
$routes->get('admin/draw/edit/(:num)', 'Admin\\Draw::edit/$1');
$routes->post('admin/draw/update', 'Admin\\Draw::update');
$routes->get('admin/draw/remove/(:num)', 'Admin\\Draw::remove/$1');

// Admin Refund (Contrat d'Excellence)
$routes->get('admin/refund', 'Admin\\Refund::index');
$routes->get('admin/refund/remove/(:num)', 'Admin\\Refund::remove/$1');

// Admin Client Support (Contactez-nous)
$routes->get('admin/client_support', 'Admin\\Client_support::index');
$routes->get('admin/client_support/remove/(:num)', 'Admin\\Client_support::remove/$1');

// Admin Country Restriction
$routes->get('admin/country', 'Admin\\Country::index');
$routes->post('admin/country/update', 'Admin\\Country::update');

// Admin SMTP Settings
$routes->get('admin/settings', 'Admin\\Settings::index');
$routes->post('admin/settings/update', 'Admin\\Settings::update');

// Admin Page Templates
$routes->get('admin/pagetemplate/viewpage', 'Admin\\PageTemplate::viewpage');
$routes->get('admin/pagetemplate/Addpage', 'Admin\\PageTemplate::Addpage');
$routes->post('admin/pagetemplate/create', 'Admin\\PageTemplate::create');
$routes->get('admin/pagetemplate/edit/(:num)', 'Admin\\PageTemplate::edit/$1');
$routes->post('admin/pagetemplate/update/(:num)', 'Admin\\PageTemplate::update/$1');
$routes->get('admin/pagetemplate/remove/(:num)', 'Admin\\PageTemplate::remove/$1');

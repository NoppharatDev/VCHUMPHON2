<?php

// require_once("{$_SERVER['DOCUMENT_ROOT']}/components/MinifyHTML.Class.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

##### GET CUSTOMER VIEW PAGE #####
get('/', 'views/home.php');
//get('/product', 'img_view.php'); 
get('/img_view/$type/$id/$size', 'img_view.php'); // View Images (Product Packages Customers)
get('/travel', '/views/package.php'); // View All Packages
get('/travel/$id', '/views/package_view.php'); // View Packages By ID
get('/travel/booking/$id', '/views/package_confirm.php'); // View Packages Booking By ID
get('/robusta', '/views/product.php'); // View All Robusta
get('/robusta/$id', '/views/product_view.php'); // View Robusta By ID
get('/product', '/views/product_partner.php'); // View Products Partner Page
get('/product/$id', '/views/product_partner_view.php'); // View Products Partner By ID
get('/my_packages', '/views/my_package.php'); // View My Packages Page
get('/my_packages/$id', '/views/my_package_view.php'); // View My Packages Page By ID
get('/my_orders', '/views/my_order.php'); // View My Orders Page
get('/my_order/$id', '/views/my_order_view.php'); // View My Order By ID
get('/invoice/$id', '/views/invoice.php'); // View Invoice Page
get('/invoice/print/$id', '/views/invoice_print.php'); // View Invoice Print Page
get('/cart', '/views/my_cart.php'); // View Carts Page
get('/cart/confirm', '/views/cart_confirm.php'); // View Carts Confirm Page
get('/login', '/views/login.php'); // View Login Page
get('/register', '/views/register.php'); // View Register Page
get('/content', '/views/content.php'); // View Contents
get('/content/$id', '/views/content_view.php'); // View Content Page By ID
get('/generator_xml', '/views/generator_xml.php'); // View generator_xml

##### POST ACTION #####
post('/robusta/$id', '/views/product_view.php');
post('/cart', '/views/my_cart.php');
post('/login', '/views/login.php');
post('/product/$id', '/views/product_partner_view.php');
post('/cart/confirm', '/views/cart_confirm.php');
post('/travel/booking/$id', '/views/package_confirm.php');
post('/register', '/views/register.php');
post('/my_packages/$id', '/views/my_package_view.php');

/*get('/user/$id', 'user.php');

get('/user/$name/$last_name', 'user.php');

get('/product/$type/color/:color', 'product.php');

get('/item/$name', 'views/items.php');*/
any('/404','404.php');

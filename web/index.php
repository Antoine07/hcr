<?php
/* ********************************************* *\
	     	        FrontController
\* ********************************************* */

require_once __DIR__.'/../app.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

<<<<<<< HEAD
if ( '/' === $uri) {
	home_action();
}elseif ( '/index.php/login' === $uri) {
	login_action();
}elseif ( '/index.php/bar' === $uri) {
	bar_action();
}elseif ( '/index.php/qg' === $uri) {
	qg_action();
}elseif ( '/index.php/shop' === $uri) {
	shop_action();
}elseif ( '/index.php/race' === $uri) {
	race_action();
} else{
=======
$prefix = '/' . getEnv('URL_PREFIX');

if ( '/' === $uri) {
		home_action();
}elseif ( $prefix.'/login' === $uri) {
	login_action();
}elseif ( $prefix.'/bar' === $uri) {
	bar_action();
}elseif ( $prefix.'/qg' === $uri) {
	qg_action();
}elseif ( $prefix.'/shop' === $uri) {
	shop_action();
}elseif ( $prefix.'/race' === $uri) {
	race_action();
}
else{
>>>>>>> feature_routing
	header('HTTP/1.1 404 Not Found');
	echo '<html><body><h1>Page Not Found</h1></body></html>';
}

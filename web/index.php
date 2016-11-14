<?php

/*------------------------------------------------------*\
			
			FrontController Hyper Cosmic Racer

\*------------------------------------------------------*/

require_once __DIR__.'/../app.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ( '/' === $uri) {
	login_action();
}
else{
	header('HTTP/1.1 404 Not Found');
	echo '<html><body><h1>Page Not Found</h1></body></html>';
}
<?php

/*------------------------------------------------------*\
			
			FrontController Hyper Cosmic Racer

\*------------------------------------------------------*/

require_once __DIR__.'/../app.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ( '/' === $uri) {
	$equipment_manager = new game\Equipment_manager(get_pdo());
	$modul_list = $equipment_manager->generate(4); 
	echo '<pre>';
	print_r($modul_list);
	echo '</pre>';
	$equipment_manager->store($modul_list);

}
else{
	header('HTTP/1.1 404 Not Found');
	echo '<html><body><h1>Page Not Found</h1></body></html>';
}
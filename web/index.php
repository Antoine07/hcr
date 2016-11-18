<?php

/*------------------------------------------------------*\
			
			FrontController Hyper Cosmic Racer

\*------------------------------------------------------*/

require_once __DIR__.'/../app.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ( '/' === $uri) {
	$equipment_manager = new game\Equipment_manager(get_pdo());
 
	$equip = new game\Equipment();
	$equip->set_id(13);
	$equip->set_activity_id(13);
	$equipment_manager->delete($equip);

}
else{
	header('HTTP/1.1 404 Not Found');
	echo '<html><body><h1>Page Not Found</h1></body></html>';
}
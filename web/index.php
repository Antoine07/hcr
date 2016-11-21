<?php

/* ********************************************* *\
	     	        FrontController
\* ********************************************* */

require_once __DIR__.'/../app.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ( '/' === $uri) {

	
	
	home_action();
}elseif ( '/login' === $uri) {
	login_action();
}elseif ( '/bar' === $uri) {
	bar_action();
}elseif ( '/qg' === $uri) {
	qg_action();
}elseif ( '/shop' === $uri) {
	shop_action();
}elseif ( '/race' === $uri) {
	race_action();

}
elseif('/NPC' === $uri) {

	if(isset($_GET["pilotes"]) && isset($_GET["mecaniciens"])) {
		generate_NPCs_action($_GET["pilotes"], $_GET["mecaniciens"]);
	}

	show_NPCs_action();

} else{
	header('HTTP/1.1 404 Not Found');
	echo '<html><body><h1>Page Not Found</h1></body></html>';
}
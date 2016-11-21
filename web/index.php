<?php session_start();

/* ********************************************* *\
	     	        FrontController
\* ********************************************* */

require_once __DIR__.'/../app.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$prefix = '/' . getEnv('URL_PREFIX');
$user_id = null;

if(isset($_SESSION['user'])) {
	$user_id = $_SESSION['user']['id'];
}


if ( '/' === $uri) {
	 if($user_id != null){
	 	header('Location: '.$prefix.'/qg');
	 	home_action();
	 }else{
	  	header('Location: '.$prefix.'/login');
	  }
}elseif ( $prefix.'/login' === $uri) {
	if($user_id != null){
	 	header('Location: /');
	 }else{
	  	login_action();
	  }
}elseif ( $prefix.'/login_post' === $uri) {
	login_post_action();
}elseif ( $prefix.'/inscription_post' === $uri) {
	store_action();
}elseif ( $prefix.'/bar' === $uri) {
	if($user_id != null){
		bar_action();
	 }else{
	  	header('Location: '.$prefix.'/login');
	 }
}elseif($prefix.'/generatenpc' === $uri) {
	generate_NPCs_action(10, 10);
 
}elseif($prefix.'/generatemodule' === $uri) {
	$module_manager = new game\Module_manager(get_pdo());

	$list_module = $module_manager->generate(10);
	
	$module_manager->store($list_module);
 
}elseif ( $prefix.'/qg' === $uri) {
	if($user_id != null){
		qg_action();
	 }else{
	  	header('Location: '.$prefix.'/login');
	  }
}elseif ( $prefix.'/shop' === $uri) {
	if($user_id != null){
		shop_action();
	 }else{
	  	header('Location: '.$prefix.'/login');
	  }
}elseif ( $prefix.'/race' === $uri) {
	if($user_id != null){
		race_action();
	 }else{
	  	header('Location: '.$prefix.'/login');
	  }
}elseif ( $prefix.'/deconnexion' === $uri) {
	deco_action();
}
else{
	header('HTTP/1.1 404 Not Found');
	echo '<html><body><h1>Page Not Found</h1></body></html>';
}

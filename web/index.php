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
}elseif($prefix.'/generatespaceships' === $uri) {

	$spaceship = new game\Spaceship();
	$spaceship->from_random();
	$manager = new game\Spaceship_manager(get_pdo());
	$manager->store($spaceship);
	$manager->update($spaceship, 'team_id', 1);

	echo '<pre>';
	print_r($spaceship->get_team());
	echo '</pre>';
	$manager->delete($spaceship);

}elseif($prefix.'/generatenpc' === $uri) {
	generate_NPCs_action(10, 10);
 
}elseif($prefix.'/generatemodule' === $uri) {
	$module_manager = new game\Module_manager(get_pdo());

	$list_module = $module_manager->generate(10);
	
	$module_manager->store($list_module);
 
}elseif($prefix.'/generateequipment' === $uri) {
	$equipment_manager = new game\Equipment_manager(get_pdo());

	$list_equipment = $equipment_manager->generate(10);
	
	$equipment_manager->store($list_equipment);
 
} elseif($prefix.'/generaterace' === $uri) {

	$manager = new game\Race_manager(get_pdo());
	$races = array_merge(
		$manager->generate(5, true, NULL, strtotime("-1 week")), 
		$manager->generate(5, false, NULL, strtotime("-1 week")),
		$manager->generate(5, true),
		$manager->generate(5, false)
	);
	$manager->store($races);
	$past_races = $manager->get_past();
	$team_manager = new game\Team_manager(get_pdo());
	$teams = $team_manager->get_all();
	
	foreach ($past_races as $key => $race) {
		foreach ($teams as $key => $team) {
			$chance = mt_rand(1,100);
			if ($chance > 50) {continue;}
			$manager->add_participant($team->get_id(), $race->get_id());
			$manager->add_log_entry($team->get_id(), $race->get_id(), 'Il s\'est passé plein de choses dans cette course !', mt_rand(1,5));
		}
	}

} elseif($prefix.'/showparticipants' === $uri) {
	$manager = new game\Race_manager(get_pdo());
	$races = $manager->get_future();
	$team_manager = new game\Team_manager(get_pdo());
	foreach ($races as $key => $race) {
		echo '<pre>';
		print_r($race);
		echo '</pre>';
		echo '<pre>';
		print_r($team_manager->get_by_race($race->get_id()));
		echo '</pre>';
	}

} elseif($prefix.'/giverewards' === $uri){
	
	$manager = new game\Race_manager(get_pdo());
	$races = $manager->get_past();
	foreach ($races as $key => $race) {
		$manager->give_rewards($race->get_id());
	}

} elseif ( $prefix.'/qg' === $uri) {
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
}elseif ( $prefix.'/buy' === $uri) {
	if($user_id != null){
		buy_action();
	 }else{
	  	header('Location: '.$prefix.'/login');
	 }
}elseif ( $prefix.'/race' === $uri) {
	if($user_id != null){
		race_action();
	 }else{
	  	header('Location: '.$prefix.'/login');
	  }
}elseif ($prefix.'/participate' === $uri) {
	if($user_id != null){
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		participate_action();
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
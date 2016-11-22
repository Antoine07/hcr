<?php 

function buy_module_action(){
	if($_SERVER['REQUEST_METHOD'] == 'POST') // si on est en méthode POST
	{
		// + pour test (création et attribution de la team)
		$test_pdo          = get_pdo();
		$test_team_manager = new game\Team_manager($test_pdo);
		/*$test_new_team = $test_team_manager->create('Sheep_hopoteam');
		$test_team_manager->store($test_new_team);*/

		$test_team = $test_team_manager->get_single(1);
		$_SESSION['user']['team_id'] = $test_team->get_id();
		// Fin du + pour test

		
		$prefix = '/' . getEnv('URL_PREFIX');
		$team_id   = $_SESSION['user']['team_id'];
		$module_id = $_POST['module_id'];

		echo '<pre>';
		  print_r($_SESSION['user']);
		echo '</pre>';

		$_SESSION['message'] = '';
		$pdo            = get_pdo();
		$module_manager = new game\Module_manager($pdo);
		$team_manager   = new game\Team_manager($pdo);
		
		$module = $module_manager->get_single($module_id);
		$team   = $team_manager->get_single($team_id);

		$mod_p = $module->get_price();
		$tea_c = $team->get_credit();
		if ($mod_p<=$tea_c) {
			$_SESSION['message'] = "Module acheté !";

			$new_tea_c = $tea_c-$mod_p;
			$team_id = $team->get_id();

			$team_manager->update($team,'credit',$new_tea_c);
			$module_manager->update($module ,'team_id',$team_id);
			header('Location: '.$prefix.'/shop');
		}else{
			$_SESSION['message'] = "Vous n'avez pas assez de crédit !";
			header('Location: '.$prefix.'/shop');
		}
		/*echo '<pre>';
			print_r($module);
			echo '<hr/><br/>';
			print_r($team);
		echo '</pre>';*/
		//$module_manager->update_team_id($module,$team);
	}
}
<?php 
	function shop_action(){
		// + pour test (création et attribution de la team)
		$test_pdo          = get_pdo();
		$test_team_manager = new game\Team_manager($test_pdo);
		/*$test_new_team = $test_team_manager->create('Sheep_hopoteam');
		$test_team_manager->store($test_new_team);*/

		$test_team = $test_team_manager->get_single(1);
		$_SESSION['user']['team_id'] = $test_team->get_id();
		// Fin du + pour test
		
		$pdo          = get_pdo();
		
		$team_id = $_SESSION['user']['team_id'];

    	$module_manager    = new game\Module_manager($pdo);
    	$equipment_manager = new game\Equipment_manager($pdo);
    	$team_manager      = new game\Team_manager($pdo);

		$team = $team_manager->get_single($team_id);

    	$mod_buyable_list 		= $module_manager->get_all_buyable();
    	$equipment_buyable_list = $equipment_manager->get_all_buyable();

    	$mod_salable_list 		= $module_manager->get_all_by_team($team);
    	$equipment_salable_list = $equipment_manager->get_team_id($team_id);
		include '../views/magasin.php' ;
		$_SESSION['message']=NULL;
	}
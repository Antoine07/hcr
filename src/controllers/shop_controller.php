<?php 
	function shop_action(){
		// + pour test (création et attribution de la team)
		$test_pdo          = get_pdo();
		$test_team_manager = new game\Team_manager($test_pdo);
		/*$test_new_team = $test_team_manager->create('Sheep_hopoteam');
		$test_team_manager->store($test_new_team);*/

		
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
		$nom_page = 'Magasin';
    	include '../views/header_team.php' ;
		include '../views/magasin.php' ;
		$_SESSION['message']=NULL;
	}
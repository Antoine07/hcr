<?php 
	function qg_action(){

		$team_id = $_SESSION['user']['team_id'];

		if (!empty($team_id)) {

		$pdo = get_pdo();


		$team_manager = new game\Team_manager($pdo);

		$team = $team_manager->get_single($team_id);

		$module_manager = new game\Module_manager($pdo);

		$list_module = $module_manager -> get_all_by_team($team);
		
		$npc_manager = new game\NPC_manager($pdo);

		$list_npc = $npc_manager -> get_where('team_id = '.$team_id);

		$spaceship_manager = new game\Spaceship_manager($pdo);

		$spaceship_manager = new game\Spaceship_manager($pdo);

		$spaceship = $spaceship_manager->get_by_team($team);
		}

		include '../views/qg.php' ;
	}
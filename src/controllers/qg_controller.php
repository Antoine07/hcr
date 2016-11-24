<?php 
	function qg_action(){

		$team_id = $_SESSION['user']['team_id'];

		$pdo = get_pdo();

		$spaceship_manager = new game\Spaceship_manager($pdo);

		$spaceship = $spaceship_manager->get_where('team_id = '.$team_id);

		$team_manager = new game\Team_manager($pdo);

		$team = $team_manager->get_single($team_id);

		$module_manager = new game\Module_manager($pdo);

		$list_module = $module_manager -> get_all_by_team($team);

		$pilot = $spaceship->get_pilot();

		$mechanic = $spaceship->get_mechanic();

		$equipment_manager = new game\Equipment_manager($pdo);

		if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){

			if (!empty($_POST['shipping'])) {
				$spaceship_manager -> update($spaceship,'nav_module_id',$_POST['shipping']);	
			}
			if (!empty($_POST['power'])) {
				$spaceship_manager -> update($spaceship,'pow_module_id',$_POST['power']);	
			}

			if (!empty($_POST['mod3'])) {

				if ($spaceship->get_modules('comp_2')){

					if ($_POST['mod3'] != $spaceship->get_modules('comp_2')->get_id()){
						$spaceship_manager -> update($spaceship,'comp_module_id_1',$_POST['mod3']);
					}

				}else{
					
					$spaceship_manager -> update($spaceship,'comp_module_id_1',$_POST['mod3']);	
				}

			}
			if (!empty($_POST['mod4'])) {
				if ($spaceship->get_modules('comp_1')){

					if ($_POST['mod4'] != $spaceship->get_modules('comp_1')->get_id()){
						$spaceship_manager -> update($spaceship,'comp_module_id_2',$_POST['mod4']);	
					} 
					
					
				} else{
					$spaceship_manager -> update($spaceship,'comp_module_id_2',$_POST['mod4']);	
				}
			}
			if (!empty($_POST['activity1'])) {
				$npc_manager = new game\NPC_manager($pdo);
				$npc_manager -> update($spaceship->get_pilot(),'activity_id',$_POST['activity1']);	
			}
			if (!empty($_POST['activity2'])) {
				$npc_manager = new game\NPC_manager($pdo);
				$npc_manager -> update($spaceship->get_mechanic(),'activity_id',$_POST['activity2']);	
			}
	
		}




		$list_equipment = $equipment_manager->get_team_id($team_id);

		$prepare=$pdo->prepare('SELECT * FROM activities WHERE name=? || name= ? || name= ? || name= ? || name= ?');
		$prepare->bindValue(1,"Utilise : La Force pour les nuls",PDO::PARAM_STR);
		$prepare->bindValue(2,"Utilise : L'Endurance pour les nuls",PDO::PARAM_STR);
		$prepare->bindValue(3,"Utilise : L'Intelligence pour les nuls",PDO::PARAM_STR);
		$prepare->bindValue(4,"Utilise : La Dexterite pour les nuls",PDO::PARAM_STR);
		$prepare->bindValue(5,"Utilise : La Vitesse pour les nuls",PDO::PARAM_STR);
		$prepare->execute();

		$list_activities = $prepare->fetchALL();

		$nom_page = 'Qg';

		include '../views/header_team.php';
		include '../views/qg.php';
	}
	
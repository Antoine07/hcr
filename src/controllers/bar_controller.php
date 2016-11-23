<?php 

	function bar_action(){
		$manager = new game\NPC_manager(get_pdo());
		$npcs_pilotes 		= $manager->get_where('job="pilote" AND team_id IS NULL');
		$npcs_mecaniciens   = $manager->get_where('job="mecanicien" AND team_id IS NULL');

		$nom_page = 'Bar';
		include '../views/header_team.php' ;
		include '../views/bar.php' ;
		$_SESSION['message'] = NULL;
	}
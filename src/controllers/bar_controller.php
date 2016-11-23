<?php 

	function bar_action(){
		$manager = new game\NPC_manager(get_pdo());
		$npcs_pilotes 		= $manager->get_where('job="pilote"');
		$npcs_mecaniciens   = $manager->get_where('job="mecanicien"');
		include '../views/bar.php' ;
		$_SESSION['message'] = NULL;
	}
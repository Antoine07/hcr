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

	function npc_stats_hide(game\NPC $npc){
		// Récupération des données
		$id = $npc->get_id();
		// Initialisation du tableau
        $hide_list=[];

        foreach ($npc->get_stats() as $key =>$stat) {
            $hide_list[$key]=false;
        }

        if (!($id%5)) {
        	$hide_list['dexterity']=true;
        	$hide_list['strength']=true;
        }else if (!($id%4)) {
        	$hide_list['stamina']=true;
        	$hide_list['intelligence']=true;
        }else if (!($id%3)) {
        	$hide_list['speed']=true;
        	$hide_list['strength']=true;
        }else if (!($id%2)) {
        	$hide_list['intelligence']=true;
        	$hide_list['speed']=true;
        }else{ 
        	$hide_list['dexterity']=true;
        	$hide_list['stamina']=true;
        }

        return $hide_list;
    }
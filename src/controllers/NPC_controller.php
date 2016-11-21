<?php

function generate_NPCs_action($nb_pilotes, $nb_mecaniciens){
	
	$npc_manager = new game\NPC_manager(get_pdo());
	$pilotes = $npc_manager->generate($nb_pilotes, 'pilote');
	$mecaniciens = $npc_manager->generate($nb_mecaniciens, 'mecanicien');
	$npc_manager->store($pilotes);
	$npc_manager->store($mecaniciens);
}
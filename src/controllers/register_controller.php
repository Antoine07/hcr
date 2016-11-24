<?php

function store_action(){	
	
	$_SESSION['old']['pseudo'] = h($_POST['pseudo']);
	$_SESSION['old']['email'] = h($_POST['email']);

	$username = h($_POST['pseudo']);
	$email = h($_POST['email']);
	$team_name = h($_POST['team_name']);

	$pdo = get_pdo();

	$query_p = sprintf('SELECT username FROM users WHERE username="'.$username.'";');
	$query_m = sprintf('SELECT email FROM users WHERE email="'.$email.'";');
	$query_t = sprintf('SELECT name FROM teams WHERE name="'.$team_name.'";');

	$verif_p = $pdo->query($query_p);
	$verif_m = $pdo->query($query_m);
	$verif_t = $pdo->query($query_t);

	if(empty($_POST['pseudo'])){
		$_SESSION['errors']['pseudo'] = 'Veuillez renseigner un pseudo';
		header('Location: /');
	}

	if(empty($_POST['password'])){
		$_SESSION['errors']['password'] = 'Veuillez renseigner un mot de passe';
		header('Location: /');
	}

	if(empty($_POST['email'])){
		$_SESSION['errors']['email'] = 'Veuillez renseigner un email';
		header('Location: /');
	}

	if(empty($_POST['team_name'])){
		$_SESSION['errors']['team_name'] = 'Veuillez renseigner un nom pour votre team';
		header('Location: /');
	}
     
	if ($donnees = $verif_p->fetch()){ $_SESSION['errors']['pseudo'] = 'Pseudo déjà utilisé'; header('Location: /');}

	if ($donnees = $verif_m->fetch()){ $_SESSION['errors']['email'] = 'Email déjà utilisé'; header('Location: /');}
	
	if ($donnees = $verif_t->fetch()){ $_SESSION['errors']['team_name'] = 'Nom de team déjà utilisé'; header('Location: /');}

	if(empty($_SESSION['errors'])){

		$username		= h($_POST['pseudo']);
		$password		= h($_POST['password']);
		$email			= h($_POST['email']);

		$creation_date = date('Y-m-d H:i:s');

	// CREATE TEAM
		$team = new game\Team;
		$team->from_name($team_name);

	// STORE TEAM
		$team_manager = new game\Team_manager($pdo);
		$team = $team_manager->store($team);
		$team_id = $team->get_id();

	// CREATE USER
		add_user($username, $password, $email, $creation_date, $team_id);

	// CREATE SPACESHIP
		$spaceship = new game\Spaceship;
		$spaceship->from_random();

	// STORE SPACESHIP
		$spaceship_manager = new game\Spaceship_manager($pdo);
		$spaceship_manager->store($spaceship);

	// CREATE MODULES
		$modules = [];
		$navigation = new game\Module;
		$navigation->from_type('shipping');
		$puissance = new game\Module;
		$puissance->from_type('speed');
		$modules[0] = $navigation;
		$modules[1] = $puissance;

	// // STORE MODULES
		$module_manager = new game\Module_manager($pdo);
		$module_manager->store($modules);
		$nav_module_id = $pdo->lastInsertId();
		$pow_module_id = $nav_module_id + 1;

	// // ATTRIBUTION DES TEAM_ID AUX MODULES
		$module_manager->update($navigation, 'team_id', $team_id);
		$module_manager->update($puissance, 'team_id', $team_id);

	// CREATE NPCs
		$NPCs = [];
		$pilote = new game\NPC;
		$pilote->from_random('pilote');
		$mecanicien = new game\NPC;
		$mecanicien->from_random('mecanicien');
		$NPCs[0] = $pilote;
		$NPCs[1] = $mecanicien;

	// STORE NPCs
		$npc_manager = new game\NPC_manager($pdo);
		$npc_manager->store($NPCs);
		$pilot_id = $pdo->lastInsertId();
		$mechanic_id = $pilot_id + 1;

		$npc_manager->update($pilote, 'team_id', $team_id);
		$npc_manager->update($mecanicien, 'team_id', $team_id);

	// UPDATE DU SPACESHIP
		$spaceship_manager->update($spaceship, 'team_id', $team_id);
		$spaceship_manager->update($spaceship, 'nav_module_id', $nav_module_id);
		$spaceship_manager->update($spaceship, 'pow_module_id', $pow_module_id);
		$spaceship_manager->update($spaceship, 'pilot_id', $pilot_id);
		$spaceship_manager->update($spaceship, 'mechanic_id', $mechanic_id);

		header('Location: /');
		exit;
	}
}
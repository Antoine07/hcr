<?php

function store_team_action(){
	
	$_SESSION['old']['team_name'] = $_POST['team_name'];

	$name = $_POST['team_name'];

	$pdo = get_pdo();

	$query = sprintf('SELECT name FROM teams WHERE name="'.$name.'";');

	$verif = $pdo->query($query);
     
	if ($donnees = $verif->fetch()){ $_SESSION['errors']['team_name'] = 'Nom d\'équipe déjà utilisé'; header('Location: /');}

	if(empty($_POST['team_name'])){
		$_SESSION['errors']['team_name'] = 'Veuillez renseigner un nom d\'équipe';
		header('Location: /');
	}



	if(empty($_SESSION['errors'])){

		$name	= $_POST['team_name'];
		$id 	=  $_SESSION['user']['id'];

		$team_manager = new game\Team_manager($pdo);
		$team_create = $team_manager->create($name);
		$team_manager->store($team_create);

		// $team = new game\Team();
		// $team->hydrate($team_single);
		push_team($name, $id);

		$_SESSION = [];

		header('Location: /');
		exit;
	}
}
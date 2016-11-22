<?php

function store_action(){	
	
	$_SESSION['old']['pseudo'] = $_POST['pseudo'];
	$_SESSION['old']['email'] = $_POST['email'];

	$username = $_POST['pseudo'];
	$email = $_POST['email'];

	$pdo = get_pdo();

	$query_p = sprintf('SELECT username FROM users WHERE username="'.$username.'";');
	$query_m = sprintf('SELECT email FROM users WHERE email="'.$email.'";');

	$verif_p = $pdo->query($query_p);
	$verif_m = $pdo->query($query_m);

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
     
	if ($donnees = $verif_p->fetch()){ $_SESSION['errors']['pseudo'] = 'Pseudo déjà utilisé'; header('Location: /');}

	if ($donnees = $verif_m->fetch()){ $_SESSION['errors']['email'] = 'Email déjà utilisé'; header('Location: /');}

	if(empty($_SESSION['errors'])){

		$username		= Security::bdd($_POST['pseudo']);
		$password		= Security::bdd($_POST['password']);
		$email			= Security::bdd($_POST['email']);

		$creation_date = date('Y-m-d H:i:s');

		add_user($username, $password, $email, $creation_date);

		header('Location: /');
		exit;
	}
}
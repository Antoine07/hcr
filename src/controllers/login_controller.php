<?php

function login_action(){
	session_start();

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$_SESSION['flash_message'] = '';
	
		$_SESSION['old']['pseudo'] = $_POST['pseudo'];
		
		$_SESSION['errors'] = '';
	}

	include '../views/login.php';
	$_SESSION = [];
}

function login_post_action(){
	session_start();
	
	
	$_SESSION['old']['pseudo'] = $_POST['pseudo'];

	$pseudo 		= $_POST['pseudo'];
	$password		= sha1(getenv('CRYPT'). $_POST['password']);


	$pdo = get_pdo();

	$query_p = sprintf('SELECT * FROM users WHERE username="'.$pseudo.'" AND password="'.$password.'";');

	$verif_p = $pdo->query($query_p);

	if(empty($_POST['pseudo'])){
		$_SESSION['errors']['pseudo'] = 'Veuillez renseigner un pseudo';
		header('Location: /login');
	}

	if(empty($_POST['password'])){
		$_SESSION['errors']['password'] = 'Veuillez renseigner un mot de passe';
		header('Location: /login');
	}
     
	if ($donnees = $verif_p->fetch() && empty($_SESSION['errors'])){ 

		$pseudo			= $_POST['pseudo'];
		$password		= sha1(getenv('CRYPT'). $_POST['password']);

		get_user($pseudo, $password);
		$_SESSION = [];
		exit;
		
	}else{
		$_SESSION['errors']['pseudo'] = 'Pseudo ou mot de passe incorrect';
		header('Location: /login');
	}
}

function deco_action(){
	session_destroy();
	header('Location: /login');
	exit;
}
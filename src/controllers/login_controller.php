<?php

function login_action(){

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
	
	$_SESSION['old']['pseudo'] = $_POST['pseudo'];

	$pseudo 		= h($_POST['pseudo']);
	$password		= sha1(getenv('CRYPT'). $_POST['password']);

	$prefix 		= getenv('URL_PREFIX');


	$pdo = get_pdo();

	$query_p = sprintf('SELECT * FROM users WHERE username="'.$pseudo.'" AND password="'.$password.'";');

	$verif_p = $pdo->query($query_p);

	if(empty($_POST['pseudo'])){
		$_SESSION['errors']['pseudo'] = 'Veuillez renseigner un pseudo';
		header('Location: /'.$prefix.'/login');
	}

	if(empty($_POST['password'])){
		$_SESSION['errors']['password'] = 'Veuillez renseigner un mot de passe';
		header('Location: /'.$prefix.'/login');
	}
     
	if ($donnees = $verif_p->fetch() && empty($_SESSION['errors'])){ 

		$username			= h($_POST['pseudo']);
		$password		= sha1(getenv('CRYPT'). $_POST['password']);

		get_user($username, $password);
		exit;
		
	}else{
		$_SESSION['errors']['pseudo'] = 'Pseudo ou mot de passe incorrect';
		header('Location: /'.$prefix.'/login');
	}
}

function deco_action(){
	$prefix 		= getenv('URL_PREFIX');
	session_destroy();
	header('Location: /'.$prefix.'/login');
	exit;
}
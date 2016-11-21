<?php 

function add_user($username, $password, $email, $creation_date){

	$pdo = get_pdo();

	$pass = sha1(getenv('CRYPT'). $password);

	$credits = 1000;

	$prepare = $pdo->prepare('INSERT INTO users (email, username, password, creation_date) VALUES (?, ?, ?, ?)') ;

	$prepare->bindValue(1, $email, PDO::PARAM_STR);
	$prepare->bindValue(2, $username, PDO::PARAM_STR);
	$prepare->bindValue(3, $pass, PDO::PARAM_STR);
	$prepare->bindValue(4, $creation_date, PDO::PARAM_STR);

	$prepare->execute();
}

function get_user($username, $password){
	$_SESSION['user'] = '';

	$pdo = get_pdo();
	
	$prepare = $pdo->prepare('SELECT * FROM users WHERE username = "'.$username.'"');
	$prepare->execute();

	while ($donnees = $prepare->fetch()):
		$_SESSION['user']['id'] = $donnees['id'];
		$_SESSION['user']['username'] = $donnees['username'];
		$_SESSION['user']['email'] = $donnees['email'];
		$_SESSION['user']['team_id'] = $donnees['team_id'];
	endwhile;


	header('Location: /');
	
}


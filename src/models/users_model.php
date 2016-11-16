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


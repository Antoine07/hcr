<?php 
function push_team($name, $id){

	$pdo = get_pdo();

	$team = 0;

	$query = sprintf('SELECT * FROM teams WHERE name="'.$name.'";');
	
	$result = $pdo->query($query);
	
	$team_id = $result->fetch(PDO::FETCH_ASSOC);

	$prepare = $pdo->prepare('UPDATE users SET team_id=? WHERE id=?') ;

	$prepare->bindValue(1, $team_id['id'], PDO::PARAM_INT);
	$prepare->bindValue(2, $id, PDO::PARAM_INT);

	$prepare->execute();
}


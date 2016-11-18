<?php namespace game;
use PDO;

class Team_manager {
	private $pdo;

	public function __construct($pdo){
		$this->set_pdo($pdo);
	}

// GENERE UNE INSTANCE DE TEAM
	public function create($name){
		$team = new Team();

		$team->from_name($name);

		return $team;
	}

// STOCK LES INSTANCES SITUES DANS $array DANS LA DB
	public function store(Team $team){

		$pdo = get_pdo();

		$name = $team->get_name();
		$credits = $team->get_credits();

		$prepare = $pdo->prepare('INSERT INTO teams (name, credit) VALUES (?, ?)') ;

		$prepare->bindValue(1, $name, PDO::PARAM_STR);
		$prepare->bindValue(2, $credits, PDO::PARAM_INT);

		$prepare->execute();
	}

// MET A JOUR L'INSTANCE PILOTE DANS LA DB
	public function update_add_pilote(NPC $instance){

	}

// SUPPRIME L'INSTANCE DE TEAM DANS LA DB
	public function delete(Team $instance){
		$pdo = $this->pdo;

		$id = $instance->get_id();

		$prepare = $pdo->prepare('DELETE FROM teams WHERE id=?');

		$prepare->bindValue('1', $id, PDO::PARAM_INT);
		$prepare->execute();
	}

// RECUPERE LES DONNEES D'UN TEAM EN FONCTION DE SON ID DANS LA DB ET RENVOIE UN INSTANCE DE TEAM
	public function get_single($id){
		$pdo = $this->pdo;

		$prepare = $pdo->prepare('SELECT * FROM teams WHERE id=?');

		$prepare->bindValue('1', $id, PDO::PARAM_INT);
		$prepare->execute();

		$team = $prepare->fetch(PDO::FETCH_ASSOC);

		return $team;
	}

// RECUPERE TOUS LES TEAM DANS LA DB ET RENVOIE UN TABLEAU CONTENANT LES INSTANCES HYDRATEES DE TEAM
	public function get_all(){
		$pdo = $this->pdo;

		$prepare = $pdo->prepare('SELECT * FROM teams ORDER BY score DESC');
		$prepare->execute();

		$teams = $prepare->fetchAll(PDO::FETCH_ASSOC);

		return $teams;
	}

// SETTER POUR PDO
	public function set_pdo($pdo)
	{
		$this->pdo = $pdo;
	}
}
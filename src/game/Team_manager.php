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

		$first_id = $this->pdo->lastInsertId();

		$team->set_id($first_id);
	}

// MET A JOUR L'INSTANCE NPC DANS LA DB
	public function update_add_npc(NPC $instance, Team $team){
 		$job = $instance->get_job();
 		$id = $team->get_id();

 		if ($job == "Pilote") { $team->set_pilote($instance); }
 		else if ($job == "Mecanicien") { $team->set_mecanicien($instance); }

 		$npc = new NPC_manager();

 		$npc->update($instance, "team_id", $id);
	}

// MET A JOUR L'INSTANCE Vaisseau DANS LA DB
	public function update_add_vaisseau(Vaisseau $instance, Team $team){
 		$id = $team->get_id();

 		$spaceship = new Spaceship_manager();

 		$spaceship->update($instance, "team_id", $id);
 		
	}

// MET A JOUR L'INSTANCE Module DANS LA DB
	public function update_add_module(Module $instance, Team $team){
 		$id = $team->get_id();

 		$team->set_module($instance);

 		$module = new Module_manager();

 		$module->update_team_id($instance, $team);
 		
	}

// MET A JOUR L'INSTANCE Equipement DANS LA DB
	public function update_add_equipement(Equipement $instance, Team $team){
		$id = $team->get_id();

		$team->set_equipement($instance);

		$equipement = new Equipement_manager();

		$equipement->update_team_id($instance, $team);
 		
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

		$result = $prepare->fetch(PDO::FETCH_ASSOC);

		if ($result['id']){
			$team = new Team();
			$team->from_db($result);
			return $team;			    	
	    }
	}

// RECUPERE TOUS LES TEAM DANS LA DB ET RENVOIE UN TABLEAU CONTENANT LES INSTANCES HYDRATEES DE TEAM
	public function get_all(){
		$pdo = $this->pdo;

		$prepare = $pdo->prepare('SELECT * FROM teams ORDER BY score DESC');
		$prepare->execute();

		$result = $prepare->fetchAll(PDO::FETCH_ASSOC);

		$teams = [];

		foreach ($result as $data) {
			$team = new Team();
			$team->from_db($data);
			$teams[] = $team;
		}

		return $teams;
	}

// SETTER POUR PDO
	public function set_pdo($pdo)
	{
		$this->pdo = $pdo;
	}
}
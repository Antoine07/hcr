<?php namespace game;
use PDO;

class Equipment_manager {
	
	private $pdo;

	public function __construct($pdo)
  {
    $this->set_pdo($pdo);
  }

// GENERE 1 OU PLUSIEURS INSTANCES DE EQUIPMENT
/**
 * [genere des equipements aléatoires]
 * @param  [int] $nb [nombre d'équipements à gérer]
 * @return [array]     [tableau contenant les instances équipements]
 */
	public function generate($nb)
	{
		$list_equipment = [];
		for ($i=0; $i <$nb ; $i++) { 
			$equipment = new Equipment();
			$equipment->from_random();
			$list_equipment[] = $equipment; 
		}
		return $list_equipment;
	}

// STOCK LES INSTANCES SITUES DANS $list_equipment DANS LA DB
/**
 * [stocke les equipements et activités associées dans la base de données]
 * @param  [array] $list_equipment [tableau d'instance des équipements]
 * @return [type]                 [description]
 */
	public function store($list_equipment)
	{
		$pdo = $this->pdo;
		$activities_id = [];
		$c = 0;
		$requete_insert_activity = 'INSERT INTO activities( name, strength, dexterity, stamina, speed, intelligence) VALUES';
		$requete_insert_equipment = 'INSERT INTO equipments( activity_id, name, brand, price) VALUES';
  
    	for ($i=0; $i < count($list_equipment); $i++) { 
    		$requete_insert_activity.=" (?, ?, ?, ?, ?, ?),";
    	}
    	$requete_insert_activity[strlen($requete_insert_activity)-1]=";";

    	for ($i=0; $i < count($list_equipment); $i++) { 
    		$requete_insert_equipment.="(?, ?, ?, ?),";
    	}
    	$requete_insert_equipment[strlen($requete_insert_equipment)-1]=";";

    	$prepare_insert_activity = $pdo->prepare($requete_insert_activity);
    	$prepare_insert_equipment = $pdo->prepare($requete_insert_equipment);

    	$i = 1;
    	foreach ($list_equipment as $equipment) {
    		$activity = $equipment->get_activity();
    		$activity_stats = $activity->get_stats();
    		$prepare_insert_activity->bindValue($i, $activity->get_name(),PDO::PARAM_STR);
    		$prepare_insert_activity->bindValue($i+1, $activity_stats["strength"], PDO::PARAM_INT);
    		$prepare_insert_activity->bindValue($i+2, $activity_stats["dexterity"], PDO::PARAM_INT);
    		$prepare_insert_activity->bindValue($i+3, $activity_stats["stamina"], PDO::PARAM_INT);
    		$prepare_insert_activity->bindValue($i+4, $activity_stats["speed"], PDO::PARAM_INT);
    		$prepare_insert_activity->bindValue($i+5, $activity_stats["intelligence"], PDO::PARAM_INT);
    		$i+=6;
    	}
    	$prepare_insert_activity->execute();
    	for ($i=0; $i < count($list_equipment); $i++) {

            $first_id = $this->pdo->lastInsertId();
            $activities_id[] = $first_id + $i;
            $list_equipment[$i]->set_activity_id($first_id + $i);
        }
        $i = 1;
    	foreach ($list_equipment as $equipment) {
    		$prepare_insert_equipment->bindValue($i, $activities_id[$c],PDO::PARAM_INT);
    		$prepare_insert_equipment->bindValue($i+1, $equipment->get_name(), PDO::PARAM_STR);
    		$prepare_insert_equipment->bindValue($i+2, $equipment->get_brand(), PDO::PARAM_STR);
    		$prepare_insert_equipment->bindValue($i+3, $equipment->get_price(), PDO::PARAM_INT);
    		$i+=4;
    		$c++;
    	}
    	$prepare_insert_equipment->execute();
    	for ($i=0; $i < count($list_equipment); $i++) {

            $first_id = $this->pdo->lastInsertId();
            $list_equipment[$i]->set_id($first_id + $i);
        }
	}

    // GENERE ET STOCK UNE INSTANCE DE Equipment
    /**
     * [populate description]
     * @param  [number] : Nombre d'Equipment(s) souhaité(s)
     * @return [nothing]!
     */
    public function populate($nb){
        $list_equipment = $this->generate($nb);
        $this->store($list_equipment);
    }

	public function update_team_id(Equipment $equipment, Team $team)
    {
        $pdo = $this->pdo;

	    $equipment_id=$equipment->get_id();
	    $team_id=$team->get_id();

	    $prepare = $pdo->prepare("
	    	UPDATE equipment
			SET team_id=?
			WHERE id=?
			");

	    $prepare->bindValue(1,$team_id,PDO::PARAM_INT);
	    $prepare->bindValue(2,$equipment_id,PDO::PARAM_INT);
	    $prepare->execute();
    }
	
// SUPPRIME L'INSTANCE DE EQUIPMENT DANS LA DB
	public function delete(Equipment $equipment)
	{
		$this->pdo->exec('DELETE FROM equipments WHERE id = '.$equipment->get_id());
		$this->pdo->exec('DELETE FROM activities WHERE id = '.$equipment->get_activity_id());
	}

// RECUPERE LES DONNEES D'UN EQUIPEMENT et DE L'ACTIVITE QUI LUI EST ASSOCIE EN FONCTION DE SON ID DANS LA DB ET RENVOIE UN INSTANCE DE XXX
	public function get_single($id)
	{
		$query  = $this->pdo->query('SELECT * FROM equipments WHERE id = '.$id);
	    $result[] = $query->fetch(PDO::FETCH_ASSOC);

	    // hydratation
	    $equipments = [];
	    $equipments = $this->hydrate($result);

	    return $equipments[0];
	}

// RECUPERE TOUS LES EQUIPEMENTS et LES ACTIVITES ASSOCIES DANS LA DB ET RENVOIE UN TABLEAU CONTENANT LES INSTANCES HYDRATEES DE EQUIPEMENT
	public function get_all()
	{
	    $query  = $this->pdo->query('SELECT * FROM equipments');
	    $result = $query->fetchAll(PDO::FETCH_ASSOC);
	    $equipments = [];

	    // hydratation
	    $equipments = [];
	    $equipments = $this->hydrate($result);
	    return $equipments;
	}

	public function get_team_id($id)
	{
		// Retourne la liste de tous les personnages du team_id donné.
		$query  = $this->pdo->query('SELECT * FROM equipments WHERE team_id = '.$id);
	    $result = $query->fetchAll(PDO::FETCH_ASSOC);
	    
	    // hydratation
	    $equipments = [];
	    $equipments = $this->hydrate($result);
	    return $equipments;	
	}

	public function get_all_buyable()
    {
    	// Retourne la liste de tous les personnages.
      	$pdo = $this->pdo;

	    $prepare = $pdo->prepare("SELECT * FROM equipments WHERE team_id IS NULL");
	    $prepare->execute();

	    $buyable_equipments = $prepare->fetchAll(PDO::FETCH_ASSOC);

	     // hydratation
      	     $list_equipment = [];
     	     $list_equipment = $this->hydrate($buyable_equipments);
      	return $list_equipment;
	}

	private function hydrate(array $list_donnee)
    	{
      	    $list_equipment = [];
      	    foreach ($list_donnee as $key => $donnee) {
        		$equipment = new Equipment();
        		$equipment->from_db($donnee);
        		$query_activity  = $this->pdo->query('SELECT * FROM activities WHERE id = '.$equipment->get_activity_id());
        		$result_activity = $query_activity->fetch(PDO::FETCH_ASSOC);
        		if ($result_activity['id']){
	    			$name = $result_activity["name"];
	    			$stats=["strength"=>$result_activity["strength"],
	    			"dexterity"=>$result_activity["dexterity"],
	    			"stamina"=>$result_activity["stamina"],
	    			"speed"=>$result_activity["speed"],
	    			"intelligence"=>$result_activity["intelligence"]];
	   			}
        		$activity = new Activity($name, $stats);
	    	$activity->from_db($result_activity); 
	    	$equipment->set_activity($activity); 
        		$list_equipment[] = $equipment;
     	}

      	     return $list_equipment;
    	}

// SETTER POUR PDO
	public function set_pdo(PDO $pdo)
   {
    $this->pdo = $pdo;
   }
}


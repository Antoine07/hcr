<?php namespace game;
use PDO;

class Equipment_manager {
	private $pdo;

	public function __construct($pdo)
  {
    $this->set_pdo($pdo);
  }

// GENERE 1 OU PLUSIEURS INSTANCES DE EQUIPMENT
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
        }
        $i = 1;
    	foreach ($list_equipment as $equipment) {
    		
    		$prepare_insert_equipment->bindValue($i, $activities_id[$c],PDO::PARAM_INT);
    		$prepare_insert_equipment->bindValue($i+1, $equipment->get_name(), PDO::PARAM_STR);
    		$prepare_insert_equipment->bindValue($i+2, $equipment->get_brand(), PDO::PARAM_STR);
    		$prepare_insert_equipment->bindValue($i+3, 0, PDO::PARAM_INT);
    		$i+=4;
    		$c++;
    	}
    	$prepare_insert_equipment->execute();

	}

// MET A JOUR L'INSTANCE EQUIPMENT DANS LA DB
	public function update(Equipment $equipment)
	{
		$pdo = $this->pdo;

		$requete_insert_equipment = 'INSERT INTO equipments( activity_id, name, brand, price) VALUES (?, ?, ?);';
		$prepare_insert_equipment = $pdo->prepare($requete_insert_equipment);
    	$prepare_insert_equipment->bindValue(1 $equipment->get_name(), PDO::PARAM_STR);
    	$prepare_insert_equipment->bindValue(2, $equipment->get_brand(), PDO::PARAM_STR);
    	$prepare_insert_equipment->bindValue(3, 0, PDO::PARAM_INT);

    	$prepare_insert_equipment->execute();
	}

// SUPPRIME L'INSTANCE DE XXX DANS LA DB
	public function delete(XXX $instance)
	{

	}

// RECUPERE LES DONNEES D'UN XXX EN FONCTION DE SON ID DANS LA DB ET RENVOIE UN INSTANCE DE XXX
	public function get_single($id)
	{

	}

// RECUPERE TOUS LES XXX DANS LA DB ET RENVOIE UN TABLEAU CONTENANT LES INSTANCES HYDRATEES DE XXX
	public function get_all()
	{

	}

// SETTER POUR PDO
	public function set_pdo(PDO $pdo)
   {
    $this->pdo = $pdo;
   }
}
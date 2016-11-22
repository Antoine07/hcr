<?php namespace game;
use PDO;

class Race_manager {
	
	private $pdo;
	public function __construct($pdo) {
		$this->set_pdo($pdo);
	}

	public function set_pdo($pdo){
		$this->pdo=$pdo;
	}

	public function generate($nb, $ladder=false, $size=NULL, $timestamp=NULL){
		$races=[];
		for ($i=0; $i < $nb; $i++) { 
			$race = new Race;
			$race->from_random($ladder, $size, $timestamp);
			$races[]=$race;
		}
		return $races;
	}

	public function store($array){
	    
	    $nb_races = count($array);

	    $request= "INSERT INTO `races` (`name`,`duration`,`ladder`, `date`) VALUES ";

	    for ($i=0; $i < $nb_races; $i++) {
	      $request.="(?,?,?,?),";
	    }

	    $request[strlen($request)-1]=";";
	    
	    $prepare=$this->pdo->prepare($request);

	    $i = 1;

	    foreach ($array as $race) {

	        $prepare->bindValue($i, (string) $race->get_name(), PDO::PARAM_STR);
	        $i++;
	        $prepare->bindValue($i, $race->get_duration(), PDO::PARAM_INT);
	        $i++;
	        $prepare->bindValue($i, (int) $race->get_ladder(),  PDO::PARAM_INT);
	        $i++;
	        $prepare->bindValue($i, $race->get_date(),  PDO::PARAM_STR);
	        $i++;
	    }

	    $prepare->execute();

		$first_id = $this->pdo->lastInsertId();

		for ($i=0; $i < count($array); $i++) {
			$id = $first_id + $i;
			$array[$i]->set_id($first_id + $i);
		}
	}

    public function populate($nb, $ladder=false, $size=NULL, $timestamp=NULL){
        $list_npc = $this->generate($nb,$ladder,$size,$timestamp);
        $this->store($list_npc);
    }
	
	public function get_single($id){
		
		$query  = $this->pdo->query('SELECT * FROM races WHERE id = '.$id);
	    $result = $query->fetch(PDO::FETCH_ASSOC);
	    if ($result['id']){
			$Race = new Race();
			$Race->from_db($result);
			return $Race;			    	
	    }
	}

	public function get_all(){

	    $query  = $this->pdo->query('SELECT * FROM races');
	    $result = $query->fetchAll(PDO::FETCH_ASSOC);
	    $races = [];

	    foreach ($result as $data) {
	    	$race = new race;
	    	$race->from_db($data);
	    	$races[] = $race;
	    }

	    return $races;
	}

	public function get_where($condition){

	    $query  = $this->pdo->query('SELECT * FROM races WHERE '.$condition);
	    $result = $query->fetchAll(PDO::FETCH_ASSOC);
	    $races = [];

	    foreach ($result as $data) {
	    	$race = new race;
	    	$race->from_db($data);
	    	$races[] = $race;
	    }

	    return $races;
	}

    public function delete(Race $race)
    {
    	$pdo = $this->pdo;
    	$id=$race->get_id();

    	$prepare = $pdo->prepare("DELETE FROM races WHERE id=?");
    	$prepare->bindValue(1,$id,PDO::PARAM_INT);
    	$prepare->execute();
    }	
}
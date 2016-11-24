<?php namespace game;
use PDO;

class NPC_manager {
	private $pdo;
	
	public function __construct(PDO $pdo){
		$this->set_pdo($pdo);
	}
// SETTERS
	public function set_pdo($pdo) {
		$this->pdo = $pdo;
	}

// METHODES MANAGEMENT

	/**
	 * [genere des NPC aléatoires]
	 * @param  [int]    $nb   [nombre de NPCs à générer]
	 * @param  [string] $type [type des NPCs 'pilote' || 'mecanicien']
	 * @return [array]        [tableau contenant les instances de NPC]
	 */
	
	public function generate($nb, $type){
		
		$NPCs = [];
		
		for ($i=0; $i < $nb; $i++) { 
			$NPC = new NPC();
			$NPC->from_random($type);
			$NPCs[] = $NPC;
		}

		return $NPCs;
	}
	
	/**
	 * [stocke les NPCs dans la base de données]
	 * @param  [array] $array [tableau d'instances de NPC]
	 * @return [type]        [description]
	 */
	public function store($array){
	    
	    $nb_NPC = count($array);

	    $request="INSERT INTO `npcs` (`name`,`race`, `job`, `price`, `strength`,`intelligence`,`stamina`,`speed`,`dexterity`) VALUES ";

	    for ($i=0; $i < $nb_NPC; $i++) {
	      $request.="(?,?,?,?,?,?,?,?,?),";
	    }

	    $request[strlen($request)-1]=";";
	    
	    $prepare=$this->pdo->prepare($request);

	    $i = 1;

	    foreach ($array as $NPC) {

	        $prepare->bindValue($i, $NPC->get_name(), PDO::PARAM_STR);
	        $i++;
	        $prepare->bindValue($i, $NPC->get_race(), PDO::PARAM_STR);
	        $i++;
	        $prepare->bindValue($i, $NPC->get_job(),  PDO::PARAM_STR);
	        $i++;
	        $prepare->bindValue($i, $NPC->get_price(),  PDO::PARAM_INT);
	        $i++;
	        $prepare->bindValue($i, $NPC->get_stats('strength'),     PDO::PARAM_INT);
	        $i++;
	        $prepare->bindValue($i, $NPC->get_stats('intelligence'), PDO::PARAM_INT);
	        $i++;
	        $prepare->bindValue($i, $NPC->get_stats('stamina'),      PDO::PARAM_INT);
	        $i++;
	        $prepare->bindValue($i, $NPC->get_stats('speed'),        PDO::PARAM_INT);
	        $i++;
	        $prepare->bindValue($i, $NPC->get_stats('dexterity'),    PDO::PARAM_INT);
	        $i++;      
	    }

	    $prepare->execute();

		$first_id = $this->pdo->lastInsertId();

		for ($i=0; $i < count($array); $i++) {
			$id = $first_id + $i;
			$array[$i]->set_id($first_id + $i);
			imagepng($array[$i]->get_image(), 'images/'.$id.'.png');
		}
	}

	/**
	 * [genere et stock des NPC aléatoires]
	 * @param  [int]    $nb   [nombre de NPCs à générer]
	 * @param  [string] $type [type des NPCs 'pilote' || 'mecanicien']
	 */
    public function populate(){
    	$pdo = $this->pdo;

        $res = $pdo->query('SELECT COUNT(*) FROM users;');

        $res = $res->fetch();

        $list_npc = $this->generate($res['COUNT(*)']*2,'pilote');
        $this->store($list_npc);        

        $list_npc = $this->generate($res['COUNT(*)']*2,'mecanicien');
        $this->store($list_npc);
    }
	
	public function update(NPC $npc, $property, $value){
	    
	    $setter = 'set_'.$property;
	    $npc->$setter($value);
	    $request=("UPDATE npcs SET ".$property."=".$value." WHERE id=".$npc->get_id());
	    $prepare=$this->pdo->prepare($request);
	    $prepare->execute();
	}

	public function do_activity(){
    	$pdo = $this->pdo;

    	$npcs = $this -> get_where('activity_id IS NOT NULL');

    	foreach ($npcs as $npc) {

    		$id = $npc->get_activity_id();

		    $request=("SELECT * from activities where id = ?");
		    $prepare=$this->pdo->prepare($request);
		    $prepare->bindValue(1,$id,PDO::PARAM_INT);
		    $prepare->execute();
		    $data = $prepare->fetch();

    		$activity = new Activity('Les connaissances pour les nuls', ['intelligence'=> 5]);

    		$activity->from_db($data);

    		$stats_npc = $npc->get_stats();
    		
    		$stats_activity = $activity->get_stats();

    		foreach ($stats_activity as $stat => $value) {
    			if ($value <= 0) continue;
    			echo $value;
    			$add = mt_rand(1, $value);
    			$new_value = $stats_npc[$stat] + $add;
    			$this->update($npc,$stat,$new_value);
    			$this->update($npc,'activity_id','null');
    		}
    	}

	}	

	public function delete(NPC $npc){

		$this->pdo->exec('DELETE FROM npcs WHERE id = '.$npc->get_id());
		$file ='images/'.$npc->get_id().'.png';
		if(file_exists($file))
			unlink($file);
	}

	public function get_single($id){
		
		$query  = $this->pdo->query('SELECT * FROM npcs WHERE id = '.$id);
	    $result = $query->fetch(PDO::FETCH_ASSOC);
	    if ($result['id']){
			$NPC = new NPC();
			$NPC->from_db($result);
			return $NPC;			    	
	    }
	}

	public function get_all(){

	    $query  = $this->pdo->query('SELECT * FROM npcs');
	    $result = $query->fetchAll(PDO::FETCH_ASSOC);
	    $NPCs = [];

	    foreach ($result as $data) {
	    	$NPC = new NPC;
	    	$NPC->from_db($data);
	    	$NPCs[] = $NPC;
	    }

	    return $NPCs;
	}

	public function get_where($where){

		$query  = $this->pdo->query('SELECT * FROM npcs WHERE '.$where);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
	   	$NPCs = [];

	  	 foreach ($result as $data) {
	    		$NPC = new NPC;
	    		$NPC->from_db($data);
	    		$NPCs[] = $NPC;
	    	}

	    	return $NPCs;
	}


}
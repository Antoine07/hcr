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
	    
	    for ($i=0; $i < $nb_NPC; $i++) {

	    	$starting_id = $this->pdo->lastInsertId();
	    	$npc_id     = $starting_id + $i;
	    	imagepng($array[$i]->get_image(), 'images/'.$npc_id.'.png');
	    }
	}
	
	public function update(NPC $npc, $property, $value){
	    
	    $setter = 'set_'.$property;
	    $npc->$setter($value);
	    $request=("UPDATE npcs SET ".$property."=".$value." WHERE id=".$npc->get_id());
	    $prepare=$this->pdo->prepare($request);
	    $prepare->execute();
	}

	public function delete(NPC $npc){

		$this->pdo->exec('DELETE FROM npcs WHERE id = '.$npc->get_id());
		$file ='images/'.$npc->get_id().'.png';
		echo '<pre>';
		print_r($file);
		echo '</pre>';
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
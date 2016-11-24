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
		
		$query  = $this->pdo->query('SELECT * FROM races WHERE id='.$id);
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

	public function get_past(){
		return $this->get_where('date < CURDATE() ORDER BY date DESC');
	}

	public function get_future(){
		return $this->get_where('date >= CURDATE() ORDER BY date');
	}

	public function get_where($condition){

	    $query  = $this->pdo->query('SELECT * FROM races WHERE '.$condition);
	    $result = $query->fetchAll(PDO::FETCH_ASSOC);
	    $races = [];

	    foreach ($result as $data) {
	    	$race = new Race;
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

    public function add_log_entry($team_id, $race_id, $content, $position) {
    	$pdo = $this->pdo;
       	$prepare = $pdo->prepare("INSERT INTO races_history (`race_id`,`team_id`, `content`, `position`) VALUES (?, ?, ?, ?);");
       	$prepare->bindValue(1, $race_id, PDO::PARAM_INT);
       	$prepare->bindValue(2, $team_id, PDO::PARAM_INT);
       	$prepare->bindValue(3, $content, PDO::PARAM_STR);
       	$prepare->bindValue(4, $position, PDO::PARAM_INT);
       	$prepare->execute();
    }

    public function get_log_entry($team_id, $race_id) {

 	    $query = $this->pdo->query('SELECT * FROM races_history WHERE team_id='.$team_id.' AND race_id='.$race_id);
	    $result = $query->fetch(PDO::FETCH_ASSOC);
	    return $result;   	
    }

    public function add_participant($team_id, $race_id) {
    	$pdo = $this->pdo;
       	$prepare = $pdo->prepare("INSERT INTO races_participants (`race_id`,`team_id`) VALUES (?, ?);");
       	$prepare->bindValue(1, $race_id, PDO::PARAM_INT);
       	$prepare->bindValue(2, $team_id, PDO::PARAM_INT);
       	$prepare->execute();
    }

    public function give_rewards($race_id){
    	
    	$race = $this->get_single($race_id);

    	$team_manager = new Team_manager($this->pdo);
    	$teams = $team_manager->get_by_race($race_id);

    	foreach ($teams as $team) {
    		$team_id = $team->get_id();
    		
    		if ($team_manager->has_participated($team_id, $race_id)) {
    			
    			$log = $this->get_log_entry($team_id, $race_id);
    			
    			if ($log['position'] <= 3) {

    				$score_reward =   (int) $race->get_score_reward($log['position']);
    				$credits_reward = (int) $race->get_credits_reward($log['position']);

    				$team_credits = $team->get_credit() + $credits_reward;
    				$team_score   = $team->get_score() + $score_reward;

    				$team_manager->update($team, 'score', $team_score);
    				$team_manager->update($team, 'credit', $team_credits);
    				
    				echo $team->get_name().' est arrivé '.$log['position'].'eme à la course '.$race->get_name().' et gagne '.$credits_reward.' credits ainsi que '.$score_reward.' points de classement';
    				
    				echo '<pre>';
    				print_r($log);
    				echo '</pre>';
    				
    				echo '<pre>';
    				print_r($team);
    				echo '</pre>';			
    			}
    		}
    	}
    }
}
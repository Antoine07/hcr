<?php namespace game;
$list_activity = [];

class Activity{
	use Trait_hydrate;
	private $name;
	private $stats;

	function __construct($name, $stats){
		$this ->set_name($name);
		$this ->set_stats($stats);      
	}
	public function from_db($data){

        $this->hydrate($data);  
    }

	public function get_name()
	{
		return $this->name;
	}
	public function get_stats()
	{
		return $this->stats;
	}
	public function set_name($name)
	{
		if (is_string($name)) {
			$this ->name  = $name;
		}else{
			throw new Exception("Erreur un str est demandé");
		}
	}
	public function set_stats($stats)
	{
		if (is_array($stats)) {
			foreach ($stats as $stat => $value) {
				if (!is_numeric($value)) {
					throw new Exception("Erreur la valeur :".$stat." n'a pas un nombre comme value");					
				}
			}
			$this ->stats =	$stats;
		}else{
			throw new Exception("Erreur un array est demandé");
		}
	}
}

$list_activity[0] = new Activity('La musculation pour les nuls', ['strength'=> 5]);
$list_activity[1] = new Activity('La survie pour les nuls', ['stamina'=> 5]);
$list_activity[2] = new Activity('Les connaissances pour les nuls', ['intelligence'=> 5]);
$list_activity[3] = new Activity('Le Kamasutra pour les nuls', ['dexterity'=> 5]);
$list_activity[4] = new Activity('Le Sprint pour les nuls', ['speed'=> 5]);

    
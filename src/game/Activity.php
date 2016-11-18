<?php namespace game;
$list_activity = [];

class Activity{
	private $name;
	private $stats;

	function __construct($name, $stats){
		$this ->set_name($name);
		$this ->set_stats($stats);      
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

$list_activity[0] = new Activity('faire des pompes', ['strength'=> 5]);
$list_activity[1] = new Activity('courir', ['stamina'=> 5]);
$list_activity[2] = new Activity('calcul mental', ['intelligence'=> 5]);

    
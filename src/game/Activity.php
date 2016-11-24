<?php namespace game;
$list_activity = [];

class Activity{
	private $name;
	private $stats = [];

	function __construct($name, $stats){
		$this ->set_name($name);
		$this ->set_stats($stats);      
	}

	use Trait_hydrate;

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
			$this ->name  = $name;

	}
	public function set_strength($strength)
	{
			$this ->stats['strength']  = $strength;

	}
	public function set_dexterity($dexterity)
	{
			$this ->stats['dexterity']  = $dexterity;

	}
	public function set_stamina($stamina)
	{
			$this ->stats['stamina']  = $stamina;

	}
	public function set_speed($speed)
	{
			$this ->stats['speed']  = $speed;

	}
	public function set_intelligence($intelligence)
	{
			$this ->stats['intelligence']  = $intelligence;

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

    
<?php namespace game;

class Race {

	use Trait_hydrate;

	private $id=NULL;
	private $name='';
	private $duration=0;
	private $ladder=false;
	private $date='';

	public function get_id(){return $this->id;}
	public function get_name(){return $this->name;}
	public function get_duration(){return $this->duration;}
	public function get_ladder(){return $this->ladder;}
	public function get_cost(){return $this->get_duration()*10;}
	public function get_date(){return $this->date;}
	public function get_credits_reward(int $position=NULL){
		
		$total_credits_reward = $this->get_duration() * 200;
		$credits_reward_1 = (int) $total_credits_reward/2;
		$credits_reward_2 = (int) 2*$credits_reward_1/3;
		$credits_reward_3 = (int) $credits_reward_1/3;

		$r = [1=>$credits_reward_1, 2=>$credits_reward_2, 3=>$credits_reward_3];
		if ($position) {
			return $r[$position];
		}
		return $r;
	}

	public function get_score_reward(int $position=NULL){

		$total_score_reward = ($this->get_ladder())? $this->get_duration()/4 : 0;
		$score_reward_1 = (int) $total_score_reward/2;
		$score_reward_2 = (int) 2*$score_reward_1/3;
		$score_reward_3 = (int) $score_reward_1/3;

		$r = [1=>$score_reward_1, 2=>$score_reward_2, 3=>$score_reward_3];
		if ($position) {
			return $r[$position];
		}
		return $r;
	}

	public function set_id(int $id){$this->id=$id;}
	public function set_name(string $name){$this->name=$name;}
	public function set_duration(int $duration){$this->duration=$duration;}
	public function set_ladder(bool $ladder){$this->ladder=$ladder;}
	public function set_date($date){$this->date=$date;}

	public function from_db($data){
		$this->hydrate($data);
	}

	public function from_random($ladder=false, $size=NULL, $timestamp=NULL) {
		
		$date = ($timestamp)? date('Y-m-d H:i:s', $timestamp) : date('Y-m-d H:i:s');
		$this->set_date($date);

		if(!$size){
			$chance = mt_rand(0, 100);
			if ($chance < 33){
				$size = 'small';
			} elseif ($chance > 66){
				$size = 'big';
			} else {
				$size = 'medium';
			}
		}

		$names = [
			'small'=>['Petite course', 'Entrainement', 'Course amicale', 'Balade', 'Excursion', 'Petit tour'],
			'medium'=>['Course', 'Randonnée', 'Chevauchée', 'Parcours', 'Croisière', 'Slalom', 'Rencontre'],
			'big'=>['Grande course', 'Marathon', 'Calvaire', 'Parcours magistral', 'Télétron', 'Grande chevauchée']
		];

		$suffixes = [
			'du Conseil des astronomes', 'Galilée', 'Kepler', 'Copernic', 'Nostradamus', "de l'amicale des robots", 'Aristote', 'de Proxima du Centaure', 'des 100 tours de Saturne', 'en soutien à Pluton', 'dans une galaxie lointaine', 'derrière la comète Halley', 'des 8 planètes', 'de la Couronne bauréale', "d'Orion", 'des météores de Pégase', 'parmi les astéroides', "d'Andromède", 'derrière Tatooine', "de l'organisation des premiers Marsiens", "vers l'infini et au delà", 'Black-Hole', 'en orbite de Kepler 14', 'Paris - Vénus', 'interstéllaire', 'du néant', 'nébulaire', 'dans la nébuleuse du Cheval', 'sur la route arc-en-ciel', 'Sagitarius', 'Gemini', 'Aquarius', 'wipEout'
		];

		$min_duration;
		$max_duration;

		switch ($size) {
			case 'small':
				$min_duration = 16;
				$max_duration = 32;
				break;
			case 'medium':
				$min_duration = 32;
				$max_duration = 48;
				break;
			case 'big':
				$min_duration = 48;
				$max_duration = 64;
				break;
			default:
				# code...
				break;
		}

		if ($ladder) {

			$names['small'] = ['Petit tournoi', 'Petite coupe', 'Micro compétition', 'Mini ligue', 'Mini championnat', 'Nano concours'];
			$names['medium'] = ['Tournoi', 'Coupe', 'Prix', 'Challenge', 'Ligue', 'Epreuve', 'Championnat', 'Concours'];
			$names['big'] = ['Hyper tournoi', 'Mega Coupe', 'Grande compétition', 'Grand prix', 'Ultra ligue', 'Grand championnat', 'Grande épreuve', 'Giga concours'];

			$min_duration+=32;
			$max_duration+=32;
		}
		
		$prefix = $names[$size][array_rand($names[$size], 1)];
		$suffix = $suffixes[array_rand($suffixes, 1)];
		
		$name = $prefix.' '.$suffix;
		$duration = mt_rand($min_duration, $max_duration);

		$this->set_name($name);
		$this->set_duration($duration);
		$this->set_ladder($ladder);

	}
}
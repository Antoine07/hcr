<?php namespace game;
use PDO;

class NPC {

	use Trait_hydrate;

	private $id      = NULL;
	private $team_id = NULL;
	private $name    = '';
	private $race    = '';
	private $job     = '';
	private $image   = '';
	private $stats   = [];
	private $price   = 0;

// HYDRATATION
	public function from_db($data){

		$this->hydrate($data);	
	}

// GENERATION
	public function from_random($job){

	// JOB
		$this->set_job($job);

	// RANDOM RACE
		$race = '';
		$rd = mt_rand(0,100);
		if ($rd < 33){
			$race = 'humain';
		} elseif ($rd > 66) {
			$race = 'alien';
		} else {
			$race = 'robot';
		}
		$this->set_race($race);
	// RANDOM NAME
		$this->set_name(generate_name($race));
	// RANDOM STATS
		$this->set_stats(generate_stats($job, $race));
	// PROCESSED PRICE
		$this->set_price(calculate_price($this->get_stats()));
	// RANDOM PORTRAIT
		$this->set_image(generate_portrait($race));
	}

// SETTERS

	public function set_id($id) {
		if(!is_numeric($id)) {
			throw new \Exception('Cette valeur n\'est pas un nombre');
		}
		$this->id = $id;
	}

	public function set_team_id($team_id) {

		if(is_null($team_id)) 
		{
			$this->team_id = $team_id;

			return;
		}

		if(!is_numeric($team_id)) {
			throw new \Exception('Cette valeur n\'est pas un nombre');
		}
		$this->team_id = $team_id;
	}

	public function set_name($name){
		if(!is_string($name)) {
			throw new \Exception('Cette valeur n\'est pas un chaine de caractères');
		}
		$this->name = $name;
	}
	public function set_race($race){
		if(!is_string($race)) {
			throw new \Exception('Cette valeur n\'est pas un chaine de caractères');
		}
		$this->race = $race;
	}
	public function set_job($job){
		if(!is_string($job)) {
			throw new \Exception('Cette valeur n\'est pas un chaine de caractères');
		}
		$this->job = $job;
	}
	public function set_image($image){
		$this->image = $image;
	}

// SETTERS STATS
	public function set_strength($value){
		if(!is_numeric($value)) {
			throw new \Exception('Cette valeur n\'est pas un nombre');
		}
		$this->stats['strength'] = $value;
	}
	public function set_dexterity($value){
		if(!is_numeric($value)) {
			throw new \Exception('Cette valeur n\'est pas un nombre');
		}
		$this->stats['dexterity'] = $value;
	}
	public function set_intelligence($value){
		if(!is_numeric($value)) {
			throw new \Exception('Cette valeur n\'est pas un nombre');
		}
		$this->stats['intelligence'] = $value;
	}
	public function set_speed($value){
		if(!is_numeric($value)) {
			throw new \Exception('Cette valeur n\'est pas un nombre');
		}
		$this->stats['speed'] = $value;
	}
	public function set_stamina($value){
		if(!is_numeric($value)) {
			throw new \Exception('Cette valeur n\'est pas un nombre');
		}
		$this->stats['stamina'] = $value;
	}

	public function set_stats($stats) {
		$this->stats = $stats;
	}

	public function set_price($price) {
		if(!is_numeric($price)) {
			throw new \Exception('Cette valeur n\'est pas un nombre');
		}
		$this->price = $price;
	}

// GETTERS

	public function get_id()		{return $this->id;     }
	public function get_team_id()	{return $this->team_id;}
	public function get_name()		{return $this->name;   }
	public function get_race()		{return $this->race;   }
	public function get_job()		{return $this->job;    }
	public function get_image()     {return $this->image;  }
	public function get_price()     {return $this->price;  }

	public function get_stats($stat=NULL){
		if($stat){
			return $this->stats[$stat];
		}
		return $this->stats;
	}	
}

function calculate_price($stats) {
	$sum = 0;
	foreach ($stats as $value) {
		$sum += $value;
	}
	return round($sum/10)*100;
}

function generate_name($race) {

	$prefixes = ['Docteur', 'Professeur', 'Général', 'Commandant', 'Amiral', 'Capitaine'];
	$titles   = ["l'exilé", 'le bélliqueux', "l'éclair", 'le borgne', 'le bâtard', "l'unijambiste", "l'incorrigible", "l'impitoyable"];
	
	$letters  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	
	$syllabes = ['cha', 'da', 'ru', 'maul', 'dre', 'lima', 'tho', 'phre', 'cya', 'rick', 'ter', 'plo', 'pil', 'gud', 'fez', 'zap', 'dos', 'kil', 'jul', 'pru', 'kla', 'mes', 'tro', 'qyl'];
	
	$first_names = 
	[
		'Garth', 'Duane', 'Edgardo', 'Danny', 'Zack', 'Pete', 'Ismael', 'Micheal', 'Virgilio', 'Titus', 'Bennie', 'Seth', 'Dustin', 'Cameron', 'Kory', 'Ray', 'Filiberto', 'Hassan', 'Jayson', 'Rob', 'Hershel', 'Larry', 'Edmund', 'Rory', 'Blaine', 'Parker', 'Garry', 'Daren', 'Stephane', 'Olene', 'Temple', 'Dorian', 'Armand', 'Lucius', 'Diego', 'Winston', 'Marco', 'Luke', 'Duke', 'Isaac', 'Walker', 'Gordon', 'Shawn', 'Peter', 'Lucius', 'Gordon', 'Darwin'
	];
	
	$last_names =
	[
		"O'Malley", "O'Connor", "O'Neil", 'Donovan', 'Carter', 'Abrams', 'smith', 'johnson', 'williams', 'jones', 'brown', 'davis', 'miller', 'wilson', 'moore', 'taylor', 'anderson', 'thomas', 'jackson', 'white', 'harris', 'martin', 'thompson', 'garcia', 'martinez', 'robinson', 'clark', 'rodriguez', 'lewis', 'lee', 'walker', 'hall', 'allen', 'young', 'hernandez', 'king', 'wright', 'lopez', 'hill', 'scott', 'green', 'adams', 'baker', 'gonzalez', 'nelson', 'carter', 'mitchell', 'perez', 'roberts', 'turner', 'phillips', 'campbell', 'parker', 'evans', 'edwards', 'collins', 'stewart', 'sanchez', 'morris', 'rogers', 'reed', 'cook', 'morgan', 'bell', 'murphy', 'bailey', 'rivera', 'cooper', 'richardson', 'cox', 'howard', 'ward', 'torres', 'peterso', 'gray', 'ramirez', 'james', 'watson', 'brooks', 'kelly', 'sanders', 'price', 'bennett', 'wood', 'barnes', 'ross', 'henderso', 'colema', 'jenkin', 'perr', 'powel', 'lon', 'patterso', 'hughe', 'flore', 'washingto', 'butle', 'simmon', 'foste', 'bryan', 'alexande', 'russel', 'griffin', 'diaz', 'hayes', 'myers', 'hamilto', 'graha', 'sullivan', 'wallace', 'wood', 'col', 'wes', 'jorda', 'owen', 'reynold', 'fishe', 'elli', 'harriso', 'gibson', 'mcdonald', 'cruz', 'marshall', 'ortiz', 'gomez', 'murray', 'freeman', 'wells', 'web', 'simpson', 'stevens', 'tucker', 'porte', 'hunter', 'hick', 'crawford', 'henry', 'boy', 'morales', 'kenned', 'warre', 'dixon', 'ramos', 'reyes', 'burns', 'gordon', 'holmes', 'hunt', 'black', 'daniel', 'palme', 'mills', 'grant', 'knight', 'ferguson', 'rose', 'stone', 'hawkins', 'dunn', 'perkins', 'hudson', 'spencer', 'garden', 'stephen', 'payne', 'pierce', 'matthew', 'arnold', 'wagner', 'willis', 'ray', 'watkins', 'olson', 'carroll', 'duncan', 'snyder', 'bradle', 'andrew', 'harper', 'fox', 'riley', 'armstrong', 'carpenter', 'weaver', 'greene', 'lawrence', 'elliot', 'chave', 'peter', 'franklin', 'lawson', 'fields', 'ryan', 'schmidt', 'vasquez', 'castillo', 'wheeler', 'chapman', 'oliver', 'montgomery', 'richard', 'williamson', 'bishop', 'morrison', 'little', 'burton', 'stanley', 'nguyen', 'george', 'jacobs', 'reid', 'garret', 'romero', 'moore', 'hoffman', 'carlson', 'holland', 'douglas', 'hopkins', 'walter', 'curtis', 'chamber', 'rhode', 'parks', 'dawson', 'santiago', 'norris', 'hardy', 'love', 'steele', 'curry', 'powers', 'schultz', 'barker', 'guzman', 'page', 'munoz', 'ball', 'keller', 'chandler', 'weber', 'leonard', 'walsh', 'lyons', 'ramsey', 'wolfe', 'schneider', 'mullins', 'benson', 'sharp', 'bowen', 'daniel', 'barbe', 'cumming', 'baldwin', 'griffith', 'stevenson', 'cohen', 'harmon', 'rodgers', 'robbins', 'newton', 'todd', 'blair', 'higgins', 'goodwin', 'maldonald', 'erickson', 'fitzgerald', 'schwartz', 'zimmerman', 'holloway', 'brock', 'poole', 'logan', 'owen', 'drake', 'wong', 'jefferson', 'park', 'morton', 'sparks', 'mckenzie', 'mcguire', 'allison', 'bridges', 'summers', 'kirby', 'baxter', 'snow', 'mosley', 'shepherd', 'larsen', 'hoover'
	];

	switch($race) {
	// HUMAN
		case 'humain':
			$prefixe = '';
			$name = '';
			$suffixe = '';

			$first_name = $first_names[array_rand($first_names, 1)];
			$last_name = $last_names[array_rand($last_names, 1)];

			$name = ucfirst($first_name).' '.ucfirst($last_name);

			$prob = mt_rand(0, 100);
			if($prob <= 10) {
				$suffixe = ' '.$titles[array_rand($titles, 1)];
			} else if ($prob >= 90) {
				$prefixe = $prefixes[array_rand($prefixes, 1)].' ';
			}

			return $prefixe.$name.$suffixe;
	// ALIEN
		case 'alien':
			$len = (int) mt_rand(2, 3);
			$prefixe = '';
			$name = '';
			$suffixe = '';

			$prob = mt_rand(0, 100);
				
			if($prob < 20){
				$name.= $letters[mt_rand(0,25)]."'";
			}

			$rd_index = array_rand($syllabes, $len);
			
			for ($i = 0; $i < count($rd_index); $i++) {
				$syll = $syllabes[$rd_index[$i]];
				
				$prob = mt_rand(1, 100);
				
				if($prob < 20 && $i > 0){
					$name.="'";
				}

				$name .= $syll;
			}

			$prob = mt_rand(0, 100);
			if($prob <= 10) {
				$suffixe = ' '.$titles[array_rand($titles, 1)];
			} else if ($prob >= 90) {
				$prefixe = $prefixes[array_rand($prefixes, 1)].' ';
			}

			return $prefixe.ucfirst($name).$suffixe;
	// ROBOT
		case 'robot':
			$name = '';

			$letter_sequence = '';
			$len = mt_rand(1, 3);
			for ($i=0; $i < $len; $i++) { 
				$letter_sequence.=$letters[mt_rand(0, 25)];
			}
			$number_sequence = '';
			$len = mt_rand(1,4);
			for ($i=0; $i < $len; $i++) { 
				$number_sequence.=mt_rand(0,9);
			}

			$prob = mt_rand(0, 100);
			if($prob <= 80) {
				$name = $letter_sequence.'-'.$number_sequence;
			} else {
				$name = $number_sequence.'-'.$letter_sequence;
			}

			return $name;	
	}
}
function generate_stats($job,$race){

    $min=75;
    $max=125;
    $bonus_job=50;
    $bonus_race=50;

    $stats = [
            "strength" => mt_rand ( $min , $max ),
            "dexterity" => mt_rand ( $min , $max ),
            "stamina"   => mt_rand ( $min , $max ),
            "speed"  => mt_rand ( $min , $max ),
            "intelligence"  => mt_rand ( $min , $max )
        ];

    if ($job=="Pilote") {
        $stats["speed"]+=$bonus_job;
        $stats["intelligence"]+=$bonus_job;
    }elseif($job=="Mecanicien"){
        $stats["stamina"]+=$bonus_job;
        $stats["strength"]+=$bonus_job;
    }
    switch ($race) {
        case 'robot':
            $stats["intelligence"]+=$bonus_race;

            $stats["dexterity"]-=$bonus_race;
            break;
        
        case 'humain':
            $stats["dexterity"]+=$bonus_race;

            $stats["strength"]-=$bonus_race;
            break;

        case 'alien':
            $stats["strength"]+=$bonus_race;

            $stats["speed"]-=$bonus_race;
            break;
    }

    return $stats;
}

function generate_portrait($race){

// IMAGE DIMENSIONS
	$w = $h = 32;

// RESSOURCES LOCATION
	$src_base = '../src/game/assets/';

// CREATE IMAGE
	$image = imagecreatetruecolor($w, $h);

// GENERATE 1 COLOR (BASE COLOR FOR HUMANS HAIR / ALIENS BODIES)
	$min_color_val = -200;
	$max_color_val = 255;
	if ($race == 'alien') {
		$min_color_val = -64;
		$max_color_val = 120;
	};

	$main_color = [
		mt_rand($min_color_val,$max_color_val), 
		mt_rand($min_color_val,$max_color_val), 
		mt_rand($min_color_val,$max_color_val)
	];

// MANAGE SATURATION
	$saturation = 1;

// WHILE SATURATION IS TOO LOW OR TOO HIGH
 	while ($saturation > 0.6 && $saturation < 0.3) {
	  	
	  	$maxs = array_keys($main_color, max($main_color));

	// IF SATURATION TOO HIGH
	   	if($saturation > 0.6){
	   	// REDUCE HIGHEST VALUE
	   		$main_color[$maxs[0]]-=10;
	   		if ($main_color[$maxs[0]] == 0) {$main_color[$maxs[0]]--;}
	// IF SATURATION TOO LOW
	   	} elseif ($saturation < 0.3) {
	   	// INCREASE HIGHEST VALUE
	   		$main_color[$maxs[0]]+=10;
	   		if ($main_color[$maxs[0]] == 0) {$main_color[$maxs[0]]++;}
	   	}
	// CALCULATE SATURATION
	   	$val_min = min($main_color);
	   	$val_max = $main_color[$maxs[0]];

	   	$del_max = $val_max - $val_min;

		$saturation = $del_max / $val_max;
 	}

// BACKGROUND COLOR IS THE OPPOSITE OF main_color
	$bg_color   = imagecolorallocate($image, 
		(int)(255-$main_color[0])/1.8, 
		(int)(255-$main_color[1])/1.8, 
		(int)(255-$main_color[2])/1.8
	);

// FILL BACKGROUND
	imagefill($image, 0, 0, $bg_color);

// COUNT PNG FILES FOR EACH FEATURE (USED TO PICK RANDOM IMAGE) AND CREATE PNG IMAGES
	$count_body     = count(glob($src_base . $race.'/body_*.png',    GLOB_BRACE));
	$count_eyes     = count(glob($src_base . $race.'/eyes_*.png',    GLOB_BRACE));
	$count_mouth    = count(glob($src_base . $race.'/mouth_*.png',   GLOB_BRACE));
	$count_clothes  = count(glob($src_base .       '/clothes_*.png', GLOB_BRACE));

	$features = [];
	$features['body']  = imagecreatefrompng($src_base.$race.'/body_'  .mt_rand(1,$count_body)   .'.png');
	$features['mouth'] = imagecreatefrompng($src_base.$race.'/mouth_' .mt_rand(1,$count_mouth)  .'.png');

// SPECIAL CASES : ROBOT
	if ($race == 'robot') {

		$count_head_part = count(glob($src_base.$race.'/head_part_*.png', GLOB_BRACE));
		$features['head_part'] = imagecreatefrompng($src_base.$race.'/head_part_'.mt_rand(1, $count_head_part).'.png');
	}

	$features['eyes']    = imagecreatefrompng($src_base.$race.'/eyes_'  .mt_rand(1,$count_eyes)   .'.png');
	$features['clothes'] = imagecreatefrompng($src_base.'clothes_'      .mt_rand(1,$count_clothes).'.png');

// SPECIAL CASES : HUMAN
	if ($race == 'humain') {

		$count_hair 	   = count(glob($src_base . $race.'/hair_*.png',        GLOB_BRACE));
		$count_facial_hair = count(glob($src_base . $race.'/facial_hair_*.png', GLOB_BRACE));
		
		$features['hair']  = imagecreatefrompng($src_base.$race.'/hair_'.mt_rand(1,$count_hair).'.png');
	// COLOR HAIR
		imagefilter($features['hair'], IMG_FILTER_COLORIZE, $main_color[0], $main_color[1], $main_color[2]);

	// THERE IS A CHANCE THAT HUMANS GROW FACIAL HAIR
		$chance = mt_rand(0,100);
		if ($chance > 60) {
			$features['facial_hair'] = imagecreatefrompng($src_base.$race.'/facial_hair_'.mt_rand(1,$count_facial_hair).'.png');
		// COLOR FACIAL HAIR
			imagefilter($features['facial_hair'], IMG_FILTER_COLORIZE, 
				$main_color[0]+mt_rand(-32, 32), 
				$main_color[1]+mt_rand(-32, 32), 
				$main_color[2]+mt_rand(-32, 32)
			);
		}
	}
// SPECIAL CASES : ALIEN
	if ($race == 'alien') {

		imagefilter($features['body'], IMG_FILTER_COLORIZE, $main_color[0], $main_color[1], $main_color[2]);
	}

// ASSEMBLE FEATURES
	foreach ($features as $name=>$img) {

	// IF FEATURE IS MOUTH OR EYE, POSITION MIGHT CHANGE RANDOMLY
		$y = ($name == 'eyes' || $name == 'mouth') ? mt_rand(-1, 1) : 0;

	// PASTE ON BASE IMG
		imagecopy($image, $img, 0, $y, 0, 0, $w, $h);
	
	}

	return $image;
}
<?php namespace game;

include 'Activity.php';

class Equipment
{
	private $name;
	private $price;
	private $marque;
	private $list_stats = ['strength', 'dexterity', 'stamina', 'speed', 'intelligence'];
    private $stats;
    private $activity=[];

    function __construct(){
        $this ->name  = $this ->generateName();
        $this ->marque  = $this ->generateMarque();
        $this ->activity = $this ->generateActivity();
    }
	public function generateStats($list_stats){
		$stats = $list_stats[array_rand($list_stats)];
		$this->stats = $stats;
	}
	public function generateName()
    {
    	$name = ['strength'=>['Altère', 'Table de musculation'],
                'dexterity'=>['console de jeu', 'bilboquet'],
                'stamina'=>['corde à sauter', 'cabine de froid'],
                'speed' =>['tapis de course','roller'],
                'intelligence'=> ['livre','échéquier']];
        $this->generateStats($this->list_stats);
        $stat = $this->stats;

        $gename = $name[$stat][array_rand($name[$stat])];
        $name 	= ['strength'=>[' kryptonique',  ' adamantique', ' en titanium'],
                'dexterity'=>[' protonique', " atomique", " plutonique"],
                'stamina'=>[' plasmique', ' cosmique', ' subatomique'],
                'speed' =>[' à particules', ' moléculaire', ' dimensionnel'],
                'intelligence'=> [' de savant humain', ' de savant extraterrestre', ' de savant synthétique']];

        $gename .= $name[$stat][array_rand($name[$stat])];

        return $gename;
    }
    
    public function generateMarque()
    {
    	$marque    = ['Kelborn','Kaomax','Lanzor','Quantics','Semoon','Arendil'];
    	$genmarque = $marque[array_rand($marque)];

        return $genmarque;
    }
    public function generateActivity()
    {
        $name = 'Utilise : '.$this->name;
        $stat = [$this->stats => rand(6,25)];

        $activity = new Activity($name, $stat);
        $this->activity[] = $activity;
        return $activity;
    } 
    public function generatePrice($price)
    {
    	$val=0;
        $price=0;
        do{
          $val+=mt_rand(15,30);
          $i = mt_rand(0,100);
        }while($i<=82);
        echo $val.'<br/>';
        $price = $val*mt_rand(7,15)*10;
        $this->price=$price;


    }
    
}
    echo '<pre>' ;
    print_r(new Equipment());

    echo '</pre>';
<?php namespace game;

include 'Activity.php';

class Equipment
{
	private $name;
	private $price;
	private $brand;
	private $list_stats = ['strength', 'dexterity', 'stamina', 'speed', 'intelligence'];
    private $stats;
    private $activity=[];

    function __construct(){
        $this ->name  = $this ->get_name();
        $this ->brand  = $this ->get_brand();
        $this ->activity = $this ->get_activity();
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
    
    public function generateBrand()
    {
    	$brand    = ['Kelborn','Kaomax','Lanzor','Quantics','Semoon','Arendil', 'Valhallax'];
    	$genbrand = $brand[array_rand($brand)];

        return $genbrand;
    }
    public function generateActivity()
    {
        $name = 'Utilise : '.$this->name;
        $stat = [$this->stats => rand(6,25)];

        $activity = new Activity($name, $stat);
        $this->activity[] = $activity;
        return $activity;
    }

    //GETTER
    public function get_stats()
    {
        return $this->stats;
    }
    public function get_list_stats()
    {
        return $this->list_stats;
    }
    public function get_name()
    {
        return $this->name;
    }
    public function get_brand()
    {
        return $this->brand;
    }
    public function get_activity()
    {
        return $this->activity;
    } 

    //SETTER
    public function set_stats($stats)
    {
        $this ->stats = $stats;
    }
    public function set_name($name)
    {
        if (is_string($name)) {
            $this ->name = $name;
        }else{
            throw new Exception("Erreur un str est demandé");
        }
    }
    public function set_brand($brand)
    {
        if (is_string($brand)) {
            $this ->brand = $brand;
        }else{
            throw new Exception("Erreur un str est demandé");
        }
    }
    public function set_activity(Activity $activity)
    {
        $this ->activity = $activity;
    }
    
    /*public function generatePrice($price)
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


    }*/
    
}
$equipement=new Equipment();

$equipement->set_brand($equipement->generateBrand());
$equipement->set_name($equipement->generateName());
$equipement->set_activity($equipement->generateActivity());

    echo '<pre>' ;
    print_r($equipement);
    echo '</pre>';
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

    function __construct()
    {

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
        $list_stats=$this->get_list_stats();
        $activity_stats=[];
        foreach ($list_stats as $stat) {
            $activity_stats[$stat]=0;
        }
        $activity_stats[$this->stats] = rand(6,25);

        $activity = new Activity($name, $activity_stats);
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
        if (is_string($stats)) {
            $this ->stats = $stats;
        }else{
            throw new Exception("Erreur un str est demandé");
        }
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
    public function from_random()
    {
        $this->set_brand($this->generateBrand());
        $this->set_name($this->generateName());
        $this->set_activity($this->generateActivity()); 
    }  
}
$equipement=new Equipment();
$equipement->from_random();


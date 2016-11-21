<?php namespace game;

include 'Activity.php';

class Equipment
{
    use Trait_hydrate;
    private $name;
    private $price;
    private $brand;
    private $list_stats = ['strength', 'dexterity', 'stamina', 'speed', 'intelligence'];
    private $stats;
    private $activity=[];
    private $id = NULL;
    private $activity_id;

    function __construct()
    {

    }
    // HYDRATATION
    public function from_db($data){

        $this->hydrate($data);  
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
        $name   = ['strength'=>[' kryptonique',  ' adamantique', ' en titanium'],
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
    public function get_stats(){return $this->stats;}
    public function get_list_stats(){return $this->list_stats;}
    public function get_name(){return $this->name;}
    public function get_brand(){return $this->brand;}
    public function get_activity(){return $this->activity;}
    public function get_id(){return $this->id;}
    public function get_activity_id(){return $this->activity_id;} 
    public function get_team_id(){return $this->team_id;}
    public function get_price(){return $this->price;}

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
    public function set_id($id)
    {
        if (!is_numeric($id)) {
            throw new Exception("Erreur la valeur :".$id." n'a pas un nombre comme value");                   
        }else{
            $this ->id = $id;
        }
    }
    public function set_activity_id($activity_id)
    {
        if (!is_numeric($activity_id)) {
            throw new Exception("Erreur la valeur :".$activity_id." n'a pas un nombre comme value");                   
        }else{
            $this ->activity_id = $activity_id;
        }
    }
    public function set_team_id($team_id)
    {
        if (!is_numeric($team_id)) {
            throw new Exception("Erreur la valeur :".$team_id." n'a pas un nombre comme value");                   
        }else{
            $this ->team_id = $team_id;
        }
    }
    public function set_price($price)
    {
        if (!$price) {
            throw new Exception("Erreur la valeur :".$price." n'a pas un nombre comme value");                   
        }else{
            $this ->price = $price;
        }
    }
    
    public function generatePrice()
    {
        $val=0;
        $price=0;
        do{
          $val+=mt_rand(15,30);
          $i = mt_rand(0,100);
        }while($i<=82);
        $price = $val*mt_rand(7,15)*10;
        $this->price=$price;
        return $price;
    }
    public function from_random()
    {
        $this->set_brand($this->generateBrand());
        $this->set_name($this->generateName());
        $this->set_activity($this->generateActivity());
        $this->set_price($this->generatePrice());  
    }  
}
$equipement=new Equipment();
$equipement->from_random();


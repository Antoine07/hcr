<?php namespace game;

class Spaceship
{

    use Trait_hydrate;

	private $id = null ;
    private $team_id = null;
    private $name = '';
    public $pilot_id = null; 
    public $mechanic_id = null;
    private $stats = [
        'cosiness' => 100,
        'shipping' => 100,
        'solidity' => 100,
        'aerodynamics' => 100,
        'speed' => 100
    ];

    public $modules_id = [

        "pow" => NULL,
        "nav" => NULL,
        "comp_1" => NULL,
        "comp_2" => NULL
    ];

    public function __construct()
    {     
    }

    public function get_name(){return $this->name;}
    public function get_id(){return $this->id;}  
    public function get_team_id(){return $this->team_id;}

    public function get_modules($type=NULL){
        $module_manager = new Module_manager(get_pdo());
        if($type){
            $module = $module_manager->get_single($this->modules_id[$type]);
        } else {
            $module = [];
            foreach ($this->modules_id as $key => $value) {
                $module[]=$module_manager->get_single($value);
            }
        }
        return $module;
    }

    public function get_team(){
        $team_manager = new Team_manager(get_pdo());
        $team = $team_manager->get_single($this->team_id);
        return $team;
    }
    public function get_pilot(){
        $npc_manager = new NPC_manager(get_pdo());
        $npc = $npc_manager->get_single($this->pilot_id);
        return $npc;
    }
    public function get_mechanic(){
        $npc_manager = new NPC_manager(get_pdo());
        $npc = $npc_manager->get_single($this->mechanic_id);
        return $npc;
    }

    public function get_stats($stat=NULL){

        $modules = $this->get_modules();
        $stats = $this->stats;
        foreach ($this->stats as $stat_name => $value) {
            foreach ($modules as $module) {
                $stats[$stat_name] += $module->get_stat($stat_name);
            }
        }
        if ($stat) {
            return $stats[$stat];
        } 
        return $stats;
    }

    public function set_shipping($value){$this->stats['shipping'] = $value;}
    public function set_id($id){$this->id = $id;}
    public function set_team_id($id){$this->team_id=$id;}
    public function set_pilot_id($id){$this->pilot_id=$id;}
    public function set_mechanic_id($id){$this->mechanic_id=$id;}
    public function set_name($name){$this->name = $name;}

    public function set_nav_module_id($id){$this->modules_id['nav'] = $id;}
    public function set_pow_module_id($id){$this->modules_id['pow'] = $id;}
    public function set_comp_module_id_1($id){$this->modules_id['comp_1'] = $id;}
    public function set_comp_module_id_2($id){$this->modules_id['comp_2'] = $id;}

    public function from_db($data)
    {
        $this->hydrate($data);
    }

    public function from_random()
    {
        $this->set_name(get_rand_name());
    }

}

function get_rand_name()
{
 
    $tab_model_name = ['Buster ', 'Speeder ', 'Viper ','Corvet ','Interceptor ','Cruser ','Titan ','Escher ','gorz ','utopie ','bruine ','puralis ','gaïa ','armado ','nothung ','karma ','dragocytos ','polymeriza ','daigusto ','emeral ','kozmoll ','shekhinaga ','traptrix ','rafflesia ','quantum ','lavalval '];  
    $code = ''; 
    $number = 0; 
    $result = ''; 
    $model_name = ''; 
    for($i=0; $i<3; $i++)
    {
        $code .= chr(mt_rand(65,90)); 
    }
    $number = mt_rand(1,999);
    $brand_name = $tab_model_name[mt_rand(0,25)];  
    $result = $model_name.$code.'-'.$number;
    return $result;          
}



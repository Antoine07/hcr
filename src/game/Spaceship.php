<?php namespace game;

class Spaceship
{

    use Trait_hydrate;

	private $id = null ;
    private $team_id = null;
    private $name = '';
    private $pilot_id = null; 
    private $mechanic_id = null;
    private $stats = [
        'cosiness' => 100,
        'shipping' => 100,
        'solidity' => 100,
        'aerodynamics' => 100,
        'speed' => 100
    ];

    private $modules_id = [

        "pow" => NULL,
        "nav" => NULL,
        "comp_1" => NULL,
        "comp_2" => NULL
    ];

    public function __construct()
    {
        $this->set_rand_name();
     
    }

    public function get_name(){return $this->name;}
    public function get_id(){return $this->id;}  
    public function get_team_id(){return $this->team_id;}

    public function get_modules($type=NULL){
        $module_manager = new game\Module_manager(get_pdo());
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
        $team_manager = new game\Team_manager(get_pdo());
        $team = $team_manager->get_single($this->team_id);
        return $team;
    }
    public function get_pilot(){
        $npc_manager = new game\NPC_manager(get_pdo());
        $npc = $npc_manager->get_single($this->pilot_id);
        return $npc;
    }
    public function get_mechanics(){
        $npc_manager = new game\NPC_manager(get_pdo());
        $npc = $npc_manager->get_single($this->mechanics);
        return $npc;
    }

    public function get_stats($stat=NULL){

        $modules = $this->get_modules();
        $stats = [];
        foreach ($modules as $module) {
            foreach ($this->stats as $stat_name => $value) {
                $stats[$stat_name] = $value + $module->get_stat($stat_name);
            }
        }
        if ($stat) {
            return $stats[$stat];
        } else {
            return $stats;
        }
    }

    public function set_shipping($value){$this->stats['shipping'] = $value;}
    public function set_id($id){$this->id = $id;}
    public function set_team_id(Team $team){$this->$team_id = $team->get_id();}
    public function set_pilot_id(NPC $npc){$this->pilot_id=$npc->get_id();}
    public function set_mechanics_id(NPC $npc){$this->mechanics_id=$npc->get_id();}

    public function set_nav_module_id(Module $module){$this->modules_id['nav'] = $module->get_id();}
    public function set_pow_module_id(Module $module){$this->modules_id['pow'] = $module->get_id();}
    public function set_comp_module_id_1(Module $module){$this->modules_id['comp_1'] = $module->get_id();}
    public function set_comp_module_id_2(Module $module){$this->modules_id['comp_2'] = $module->get_id();}

    public function from_db($data)
    {
        $this->hydrate($data);
    }

    public function from_random($team_id);
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



<?php namespace game;

class Spaceship
{
		private $id = null ;
        private $name = '';
        private $stats = [
        'aerodynamics' => 100,
        'solidity' => 100,
        'cosiness' => 100,
        'speed' => 100,
        'shipping' => 100
        ];

        private $modules = [];

        public function __construct()
        {
            $this->set_rand_name();
         
        }

        public function set_name($name)
        {
        	$this->name = $name; 
        }

        public function get_name(){
        	return $this->name;
        }

        public function set_aerodynamics($aerodynamic)
        {
        	$this->stats['aerodynamics'] = $aerodynamic; 
        }

        public function set_solidity($solidity)
        {
        	$this->stats['solidity'] = $solidity; 
        }

        public function set_cosiness($cosiness)
        {
        	$this->stats['cosiness'] = $cosiness; 
        }

        public function set_speed($speed)
        {
        	$this->stats['speed'] = $speed; 
        }

        public function set_shipping($shipping)
        {
        	$this->stats['shipping'] = $shipping; 
        }

        public function set_id($id)
        {
        	$this->id = $id; 
        }

        public function set_module($type, $module)
        {
            $this->modules[$type] = $module;
        }

        public function get_modules()
        {
            return $this->modules;
        }

        public function set_stats($stats)
        {
            foreach ($stats as $stat) 
            {
                if (!is_numeric($stat)) {
                    throw new Exception('Cette stat: '.$stat.' n\'est pas un chaine de caractères');
                }
            }
            $this->stats=$stats;
        }

        public function get_stats()
        {
            return $this->stats;
        }

        public function get_id()
        {
        	return $this->id;
        }

        public function get_stats_modules()
        {
            $stats_spaceship=$this->get_stats();
            foreach ($this->modules as $module) {
                foreach ($stats_spaceship as $stat=>$value) {
                    $stats_module = $module->get_stats();
                    $stats_spaceship[$stat]+=$stats_module[$stat];
                }
            }
            return $stats_spaceship;
        }


     private function set_rand_name(){
 
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
	        $this->name=$result; 
	        
		}

		public function hydrate(array $data)
		{
			foreach ($data as $key => $value) 
			{
				$method = 'set_'.ucfirst($key); 

				if(method_exists($this, $method))
				{
					$this->$method($value);
				}	
			}		
		}
}



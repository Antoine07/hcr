<?php namespace game;

class Module {
  private $id=NULL;
  private $name;
  private $price;
  private $brand;
  private $type;
  private $timestamp;
  private $stats = [
    'aerodynamics' => 0,
    'solidity' => 0,
    'cosiness' => 0,
    'speed' => 0,
    'shipping' => 0
  ];
  
  // getter
  public function get_id()        {return $this->id;}
  public function get_name()      {return $this->name;}
  public function get_price()     {return $this->price;}
  public function get_brand()     {return $this->brand;}
  public function get_type()      {return $this->type;}
  public function get_timestamp() {return $this->timestamp;}
  public function get_stats()     {return $this->stats;}

  // setter
  public function set_id(int $value)          {$this->id    = $value;}
  public function set_name(string $value)     {$this->name  = $value;}
  public function set_price(int $value)       {$this->price = $value;}
  public function set_brand(string $value)    {$this->brand = $value;}
  public function set_type(string $value)     {$this->type  = $value;}
  public function set_aerodynamics(int $value){$this->stats['aerodynamics']  = $value;}
  public function set_solidity(int $value)    {$this->stats['solidity']      = $value;}
  public function set_cosiness(int $value)    {$this->stats['cosiness']      = $value;}
  public function set_speed(int $value)       {$this->stats['speed']         = $value;}
  public function set_shipping(int $value)    {$this->stats['shipping']      = $value;}

  public function from_random() {
    $this->set_rand_type();
    $this->set_rand_stats();
    $this->set_rand_name();
    $this->set_rand_brand();
    $this->timestamp = time();
  }

  public function hydrate(array $data) {
    foreach ($data as $key => $value) {
      $method = 'set_'.ucfirst($key);

      if (method_exists($this, $method)) {
        $this->$method($value);
      }
    }
  }

  private function set_rand_name(){
    $name = '';
    switch ($this->type) {
      case 'shipping':
        $name .= 'Navigation';
        break;
      case 'speed':
        $name .= 'Reacteur';
        break;
      case 'complementaire':
        $statMax = array_search(max($this->stats),$this->stats);
        switch ($statMax) {
          case 'aerodynamics' :
            $tName=['Aileron','Tete','Aile','Aéroloupe','Moteur'];
            $name .= $tName[array_rand($tName)];
            $tName=[' qui glisse',' léger(e)', ' lisse',' aérodynamique',' interstellaire',' fin(e)',' GEMINI'];
            $name .= $tName[array_rand($tName)];

            break;
          case 'solidity' :
            $tName=['Coque','Bouclier','Champ de protection','Blindage','Drone de défense'];
            $name .= $tName[array_rand($tName)];
            $tName=[' solide',' bien dur',' impénétrable', ' exosolaire',' ONIX',' TITANIUM',' COLOSSUS',' TITAN'];
            $name .= $tName[array_rand($tName)];

            break;
          case 'cosiness' :
            $tName=['Cockpit','Siège en cuir','Oreiller','Climatisation','Lampe à lave'];
            $name .= $tName[array_rand($tName)];
            $tName=[' en mousse',' rambouré',' jolie',' sublime',' magnifique',' moche',' horrible',' GALILEO'];
            $name .= $tName[array_rand($tName)];

            break;
          case 'speed' :
            $tName=['Propulseur','Booster','Nitro','Turbo','Technograde'];
            $name .= $tName[array_rand($tName)];
            $tName=[' puissant',' DRAKO',' Vulkan',' Ragnarok',' à matière noire',' thermique',' qui pète', ' ISS'];
            $name .= $tName[array_rand($tName)];

            break;
          case 'shipping' :
            $tName=['Radar','Détecteur','Boussole','GPS','Rétroviseur','Drone suiveur','Ordinateur de bord'];
            $name .= $tName[array_rand($tName)];
            $tName=[' précis',' à micro-ondes',' substellaire',' intergalactique',' du turfu'];
            $name .= $tName[array_rand($tName)];

            break;
          
          default:
            # code...
            break;
        }
        break;
      
      default:
        $name = 'Objet';
        break;
    }
    $name.=' ';
    $ascii=mt_rand(65,90);
    $name.=chr($ascii);
    $ascii=mt_rand(65,90);
    $name.=chr($ascii).'-';
    $nb=mt_rand(1,999);
    $name.=$nb;

    $this->name =$name;
  }

  function set_rand_stats(){
    switch ($this->type) {
      case 'speed':
        $val=mt_rand(50,150);
        $this->stats['speed']=$val;
        $price = round($val*f_rand(0.7,1.5))*10;
        $this->price=$price;
        break;
      case 'shipping':
        $val=mt_rand(50,150);
        $this->stats['shipping']=$val;
        $price = round($val*f_rand(0.7,1.5))*10;
        $this->price=$price;
        break;
      case 'complementaire':
        $val=0;
        $price=0;
        do{
          $val+=mt_rand(15,30);
          $i = mt_rand(0,100);
        }while($i<=80);
        $price = round($val*f_rand(0.7,1.5))*10;
        $this->price=$price;

        $indices = [];
        for ($i=0; $i < 3; $i++) { 
          $indices[] = array_rand($this->stats);
        }

        while($val>0)
        {
          $nbRand = mt_rand(0,$val);
          $nbRand *= (mt_rand(0,10)%10)? 1:-1; // Une chance sur 10 que l'on obtiène un malus
          $statRand = $indices[mt_rand(0,count($indices)-1)];

          $this->stats[$statRand]+=$nbRand;

          $val-=$nbRand;
        }

        break;
      
      default:
        # code...
        break;
    }
  }

  private function set_rand_brand(){
    $possible_brand = ['Mokotoz','SpaceShip Maker','Travespace','SheepWar'];

    $index = array_rand($possible_brand);

    $this->brand = $possible_brand[$index];
  }

  private function set_rand_type(){
    $possible_type = ['speed','shipping','complementaire'];

    $index = array_rand($possible_type);

    $this->type = $possible_type[$index];

  }

}
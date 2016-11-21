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
  public function get_stat(string $name){return $this->stats[$name];}

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

  use Trait_hydrate;

  // GENERE DES VALEURS ALEATOIRE DE L'INSTANCE
  public function from_random() {
    $this->set_rand_type();
    $this->set_rand_stats();
    $this->set_rand_name();
    $this->set_rand_brand();
    $this->timestamp = date('Y-m-d H:i:s');
  }

  // HYDRATATION DE L'INSTANCE
  public function from_db(array $data) {
    $this->hydrate($data);
  }

  // GENERE UN NOM DE MODULE ALEATOIRE
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
            $tName=['Aileron','Tete','Aile'];
            $name .= $tName[array_rand($tName)];
            $tName=[' qui glisse',' léger', ' lisse',' aérodinamique'];
            $name .= $tName[array_rand($tName)];

            break;
          case 'solidity' :
            $tName=['Coque','Bouclier','Champ de protection'];
            $name .= $tName[array_rand($tName)];
            $tName=[' solide',' bien dur',' impénétrable', ' exosolaire',' ONIX',' TITANIUM',' COLOSSUS',' TITAN'];
            $name .= $tName[array_rand($tName)];

            break;
          case 'cosiness' :
            $tName=['Cockpit','Siège en cuir','Oreiller','Climatisation','Lampe à lave'];
            $name .= $tName[array_rand($tName)];
            $tName=[' en mousse',' rambouré',' jolie',' sublime',' magnifique',' moche',' horrible'];
            $name .= $tName[array_rand($tName)];

            break;
          case 'speed' :
            $tName=['Propulseur','Booster','Nitro','Turbo'];
            $name .= $tName[array_rand($tName)];
            $tName=[' puissant',' DRAKO',' Vulkan',' Ragnarok',' à matière noire',' thermique',' qui pète'];
            $name .= $tName[array_rand($tName)];

            break;
          case 'shipping' :
            $tName=['Radar','Détecteur','Boussole','GPS','Rétroviseur'];
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

  // GENERE UN PRIX ALEATOIRE EN FONCTION DE VAL
  function set_rand_price($val){
        $price = round($val*f_rand(0.7,1.5))*10;

        return $price;
  }

  // GENERE DES BONUS/MALUS ALEATOIRE DANS LES STATS
  function set_rand_stats(){
    $val=0;
    switch ($this->type) {
      case 'speed':
      case 'shipping':
        $val=mt_rand(50,150);
        $this->stats[$this->type]=$val;
        break;

      case 'complementaire':
        do{
          $val+=mt_rand(15,30);
          $i = mt_rand(0,100);
        }while($i<=80);

        $indices = [];
        for ($i=0; $i < 3; $i++) { 
          $indices[] = array_rand($this->stats);
        }
        $i=$val;
        while($i>0)
        {
          $nbRand = mt_rand(0,$i);
          $nbRand *= (mt_rand(0,10)%10)? 1:-1; // Une chance sur 10 que l'on obtiène un malus
          $statRand = $indices[mt_rand(0,count($indices)-1)];

          $this->stats[$statRand]+=$nbRand;

          $i-=$nbRand;
        }
        break;
      
      default:

        break;
    }
    $price = $this->set_rand_price($val);
    $this->set_price($price);
  }

  // GENERE UNE MARQUE ALEATOIRE
  private function set_rand_brand(){
    $possible_brand = ['Mokotoz','SpaceShip Maker','Travespace','SheepWar'];

    $index = array_rand($possible_brand);

    $this->brand = $possible_brand[$index];
  }

  // GENERE UN TYPE DE MODULE ALEATOIRE
  private function set_rand_type(){
    $possible_type = ['speed','shipping','complementaire'];

    $index = array_rand($possible_type);

    $this->type = $possible_type[$index];
  }
}
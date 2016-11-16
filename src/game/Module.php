<?php namespace game;

class Module {
  private $name;
  private $price;
  private $brand;
  private $type;
  private $timestamp;
  private $stats = [
    'aerodynamics' => 0,
    'solidarity' => 0,
    'cosiness' => 0,
    'speed' => 0,
    'shipping' => 0
  ];

  function __construct() {

    $this -> getRandType();

    $this -> getRandStat();

    $this -> getRandName();

    $this -> getRandBrand();

    $this ->timestamp = time();


  }

  private function getRandName(){
    $name = '';
    switch ($this->type) {
      case 'shipping':
        $name .= 'shipping';
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
          case 'solidarity' :
            $tName=['Coque','Bouclier','Champ de protection'];
            $name .= $tName[array_rand($tName)];
            $tName=[' solide',' bien dur',' impénétrable', ' exosolaire',' ONIX',' TITANIUM',' COLOSSUS',' TITAN'];
            $name .= $tName[array_rand($tName)];

            break;
          case 'cosiness' :
            $tName=['Cockpit','Siège en cuir','Oreiller','Climatisation','Lampe à lave'];
            $name .= $tName[array_rand($tName)];
            $tName=[' cosinessable',' en mousse',' rambouré',' jolie',' sublime',' magnifique',' moche',' horrible'];
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

  function getRandStat(){
    switch ($this->type) {
      case 'speed':
        $this->stats['speed']=mt_rand(50,150);
        break;
      case 'shipping':
        $this->stats['shipping']=mt_rand(50,150);
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

  private function getRandBrand(){
    $possible_brand = ['Mokotoz','SpaceShip Maker','Travespace','SheepWar'];

    $index = array_rand($possible_brand);

    $this->brand = $possible_brand[$index];
  }

  private function getRandType(){
    $possible_type = ['speed','shipping','complementaire'];

    $index = array_rand($possible_type);

    $this->type = $possible_type[$index];

  }

  public function get_stats(){
    return $this->stats;
  }
  
  public function get_name(){
    return $this->name;
  }
  public function get_brand(){
    return $this->brand;
  }
  public function get_price(){
    return $this->price;
  }
  public function get_type(){
    return $this->type;
  }
  public function get_timestamp(){
    return $this->timestamp;
  }


}
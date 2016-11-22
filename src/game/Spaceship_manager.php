<?php 
namespace game; 
use pdo; 
class Spaceship_manager
{
	private $pdo; 

	 public function __construct(PDO $pdo)
    {
        $this->set_pdo($pdo); 
    }

    public function generate(Team $team )
    {
       $spaceship =  new Spaceship();
       $spaceship->from_random(); 
        return $spaceship; 

    }


    // STOCK LES INSTANCES SITUES DANS $array DANS LA DB
    public function store(Spaceship $spaceship)
    {
    	$pdo = $this->get_pdo(); 
    	$req = ('INSERT INTO spaceships(name,aerodynamics,solidity,cosiness,shipping,speed,team_id) VALUES(?,?,?,?,?,?,?)');


    	$stats = $spaceship->get_stats();


    	$prepare = $pdo->prepare($req); 

    	$prepare->bindValue(1,$spaceship->get_name(), PDO::PARAM_STR); 
    	$prepare->bindValue(2,$stats['aerodynamics'], PDO::PARAM_INT); 
    	$prepare->bindValue(3,$stats['solidity'], PDO::PARAM_INT); 
    	$prepare->bindValue(4,$stats['cosiness'], PDO::PARAM_INT);
    	$prepare->bindValue(5,$stats['shipping'], PDO::PARAM_INT);
    	$prepare->bindValue(6,$stats['speed'], PDO::PARAM_INT);
    	$prepare->bindValue(7,$spaceship->get_id(), PDO::PARAM_INT);
    	$prepare->execute();



    }

    // MET A JOUR L INTERFACE spaceship DANS LA DB
    public function update(Spaceship $spaceship, $value,$property)
    {
    	$setter = 'set_'.$property; 
    	$spaceship->$setter($value); 
    	$request=("UPDATE spaceships SET ".$property."=".$value." WHERE id=".$spaceship->get_id()); 
    	$prepare=$this->pdo->prepare($request);
    	$prepare->execute(); 
    } 

	// SUPPRIME L'INSTANCE DE XXX DANS LA DB
	public function delete(Spaceship $spaceship)
	{
		$pdo=$this->get_pdo(); 
		$request = "DELETE FROM spaceships WHERE id=?"; 
		$prepare = $pdo->prepare($request);
		$prepare->bindValue(1,$spaceship->get_id(),PDO::PARAM_INT); 
		$prepare->execute();

	}

// RECUPERE LES DONNEES D'UN XXX EN FONCTION DE SON ID DANS LA DB ET RENVOIE UN INSTANCE DE XXX
    public function get_single($id)
    {
    	$pdo = $this->get_pdo(); 
    	$request = "SELECT * FROM spaceships WHERE id=?"; 
    	$prepare =  $pdo->prepare($request); 
    	$prepare-> bindValue(1,$id,PDO::PARAM_INT); 

    	$prepare->execute();
    	
        $prepare->fetch(PDO::FETCH_ASSOC);

        $list_spacehips = [];
        $list_spacehips = $this->hydrate($donnee_module);
        $spaceship = $list_spacehips[0];

        return $spaceship; 
    }

       public function get_by_team(Team $team)
    {
        $pdo = $this->get_pdo();

        $id = $team->get_id();

        $request = "SELECT * FROM spaceships WHERE team_id=?"; 

        $prepare =  $pdo->prepare($request); 

        $prepare-> bindValue(1,$id,PDO::PARAM_INT); 

        $prepare->execute();

        $donnee_module = $prepare->fetch(PDO::FETCH_ASSOC);

        $list_spacehips = [];
        $list_spacehips = $this->hydrate($donnee_module);
        $spaceship = $list_spacehips[0];

        return $spaceship;
    }


// RECUPERE TOUS LES XXX DANS LA DB ET RENVOIE UN TABLEAU CONTENANT LES INSTANCES HYDRATEES DE XXX
    public function get_all()
    {
    	$pdo = $this->get_pdo(); 
    	$request = "SELECT * FROM spaceships "; 
    	$prepare =  $pdo->prepare($request); 
    	$prepare->execute();
    	return $prepare->fetchAll(PDO::FETCH_ASSOC); 

        $list_spacehips = [];
        $list_spacehips = $this->hydrate($donnee_module);
        return $list_spacehips;
    }


// GETTER
	public function get_pdo()
	{
		return $this->pdo; 
	}

// SETTER 
    public function set_pdo($pdo)
    {
    	$this->pdo = $pdo; 
    }

    /**
     * @param  [array] : Tableau de tableau associatif contenant les propriétés d'un objet
     * @return [array] : Tableau contenant instance(s) hydratée(s) de Module
     */
    private function hydrate(array $list_donnee)
    {
      $list_spacehips = [];
      foreach ($list_donnee as $key => $donnee) {
        $spaceship = new Spaceship();
        $spaceship->from_db($donnee);
        $list_spacehips[] = $spaceship;
      }

      return $list_spacehips;
    }
}



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

    public function generate(){
       $spaceship =  new Spaceship();
       $spaceship->from_random(); 
       return $spaceship; 
    }

    // STOCK LES INSTANCES SITUES DANS $array DANS LA DB
    public function store(Spaceship $spaceship)
    {
    	$pdo = $this->get_pdo(); 
    	$req = ('INSERT INTO spaceships(name,team_id,pilot_id,mechanic_id,nav_module_id,pow_module_id,comp_module_id_1,comp_module_id_2) VALUES(?,?,?,?,?,?,?,?)');

    	$prepare = $pdo->prepare($req); 

    	$prepare->bindValue(1,$spaceship->get_name(), PDO::PARAM_STR); 
        $prepare->bindValue(2,$spaceship->get_team_id(),PDO::PARAM_INT);
        $prepare->bindValue(3,$spaceship->modules_id['nav'],PDO::PARAM_INT);
        $prepare->bindValue(4,$spaceship->modules_id['pow'],PDO::PARAM_INT);
    	$prepare->bindValue(5,$spaceship->modules_id['comp_1'],PDO::PARAM_INT);
        $prepare->bindValue(6,$spaceship->modules_id['comp_2'],PDO::PARAM_INT);
        $prepare->bindValue(7,$spaceship->pilot_id, PDO::PARAM_INT);
        $prepare->bindValue(8,$spaceship->mechanic_id, PDO::PARAM_INT);

    	$prepare->execute();

        $spaceship->set_id($this->pdo->lastInsertId());

        return $this->pdo->lastInsertId();
    }

    // MET A JOUR L INTERFACE spaceship DANS LA DB
    public function update(Spaceship $spaceship, $property, $value)
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
        $query  = $this->pdo->query('SELECT * FROM spaceships WHERE id = '.$id);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result['id']){
            $spaceship = new Spaceship();
            $spaceship->from_db($result);
            return $spaceship;                    
        }
    }
// RECUPERE LES DONNEES D'UN XXX EN FONCTION DE SON ID DANS LA DB ET RENVOIE UN INSTANCE DE XXX
    public function get_by_team($id)
    {
       return $this->get_where("team_id=".$id);
    }
// RECUPERE TOUS LES XXX DANS LA DB ET RENVOIE UN TABLEAU CONTENANT LES INSTANCES HYDRATEES DE XXX
    public function get_all()
    {
    	$pdo = $this->get_pdo(); 
    	$request = "SELECT * FROM spaceships "; 
    	$prepare =  $pdo->prepare($request); 
    	$prepare->execute();
    	$array = $prepare->fetchAll(PDO::FETCH_ASSOC); 

        $spaceships = [];
        foreach ($array as $data) {
            $spaceship = new Spaceship();
            $spaceship->hydrate($data);
            $spaceships[] = $spaceship;
        }
        return $spaceships;
    }

    public function get_where($where) {
        $query  = $this->pdo->query('SELECT * FROM spaceships WHERE '.$where);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $spaceships = [];

        foreach ($result as $data) {
            $spaceship = new Spaceship;
            $spaceship->from_db($data);
            $spaceships[] = $spaceship;
        }
        if (count($spaceships) == 1) {
            return $spaceships[0];
        }
        return $spaceships;
    }

    public function unequip_module($spaceship, $module) {
        $type_name = NULL;
        foreach ($spaceship->modules_id as $type => $module_id) {
            if ($module->get_id() == $module_id) {
                switch ($type) {
                    case 'pow':
                        $type_name = 'pow_module_id';
                        break;
                    case 'nav':
                        $type_name = 'nav_module_id';
                        break;
                    case 'comp_1':
                        $type_name = 'comp_module_id_1';
                        break;    
                    case 'comp_2':
                        $type_name = 'comp_module_id_2';
                        break;
                }
            }
        }
        if ($type_name) {

            $this->update($spaceship, $type_name, 'NULL');
        }
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
}



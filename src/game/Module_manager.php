<?php namespace game; 
use PDO;

class Module_manager {
	private $pdo;

    public function __construct($db)
    {
      $this->set_pdo($db);
    }

    public function generate($nb)
    {
    	$list_module = [];

	    for($i=0;$i<$nb;$i++){
	      $modul = new Module();
	      $modul->from_random();
	      $list_module[] = $modul;
	    }
	    	echo '<pre>';
	    		print_r($list_module);
	    	echo '</pre>';
	    return $list_module;
    }
    public function store(array $list_module)
    {
    	if (!is_array($list_module)) throw new Exception("Merci de renseigner un tableau", 1);

	    $pdo = $this->pdo;

	    $nb_mod = count($list_module);

	    $requete=("INSERT INTO `modules` (`name`,`price`,`brand`,`type`,`timestamp`,`aerodynamics`,`solidity`,`cosiness`,`speed`,`shipping`) VALUES ");
	    
	    for ($i=0; $i < $nb_mod; $i++) {
	      $requete.="(?,?,?,?,?,?,?,?,?,?),";
	    }

	    $requete[strlen($requete)-1]=";";

	    $prepare=$pdo->prepare($requete);

	    $i = 0;

	    foreach ($list_module as $mod) {
	      $name = $mod->get_name();
	      $i++;
	      $prepare->bindValue($i,$name,PDO::PARAM_STR);

	      $price = $mod->get_price();
	      $i++;
	      $prepare->bindValue($i,$price,PDO::PARAM_INT);

	      $brand = $mod->get_brand();
	      $i++;
	      $prepare->bindValue($i,$brand,PDO::PARAM_STR);

	      $type = $mod->get_type();
	      $i++;
	      $prepare->bindValue($i,$type,PDO::PARAM_STR);
	      
	      $timestamp = $mod->get_timestamp();
	      $i++;
	      $prepare->bindValue($i,$timestamp,PDO::PARAM_STR);

	      $stats = $mod->get_stats();

	      foreach ($stats as $stat) {
	        $i++;
	        $prepare->bindValue($i,$stat,PDO::PARAM_INT);
	      }
	    }

		$prepare->execute();
	    // Assignation des valeurs pour le nom, la force, les dégâts, l'expérience et le niveau du  personnage.
	    // Exécution de la requête.
    }

    // GET
    public function get_single($id)
    {
    	// Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet  Module.
	    $pdo = $this->pdo;

	    $prepare = $pdo->prepare("SELECT * FROM modules WHERE id=?");
	    $prepare->bindValue(1,$id,PDO::PARAM_INT);
	    $prepare->execute();

		$module = $prepare->fetch(PDO::FETCH_ASSOC);

		return $module;
    }
    public function get_all()
    {
    	// Retourne la liste de tous les personnages.
      	$pdo = $this->pdo;

	    $prepare = $pdo->prepare("SELECT * FROM modules");
	    $prepare->execute();

	    $modules = $prepare->fetchAll(PDO::FETCH_ASSOC);

	    return $modules;
    }
    public function get_all_buyable()
    {
    	// Retourne la liste de tous les personnages.
      	$pdo = $this->pdo;

	    $prepare = $pdo->prepare("SELECT * FROM modules WHERE team_id=NULL");
	    $prepare->execute();

	    $buyable_modules = $prepare->fetchAll(PDO::FETCH_ASSOC);

	    return $buyable_modules;
    }
    // //FIN GET


    // Update
    public function delete(Module $module)
    {
	    $pdo = $this->pdo;
	    $id=$module->get_id();

	    $prepare = $pdo->prepare("DELETE FROM modules WHERE id=?");
	    $prepare->bindValue(1,$id,PDO::PARAM_INT);
	    $prepare->execute();
    }

	// todo : tester l'update de la FK
    public function update_team_id(Module $module, Team $team)
    {
        $pdo = $this->pdo;

	    $mod_id=$module->get_id();
	    $tea_id=$team->get_id();

	    $prepare = $pdo->prepare("
	    	UPDATE modules
			SET team_id=?
			WHERE id=?
			");

	    $prepare->bindValue(1,$tea_id,PDO::PARAM_INT);
	    $prepare->bindValue(2,$mod_id,PDO::PARAM_INT);
	    $prepare->execute();
    }
    public function set_pdo($pdo)
    {
      $this->pdo = $pdo;
    }
}
<?php namespace game; 
use PDO;

class Module_manager {
	private $pdo;

    public function __construct($db)
    {
      $this->set_pdo($db);
    }

	// GENERE 1 OU PLUSIEURS INSTANCES DE Module avec des propriétés aléatoire
    /**
     * @param  [number] : Nombre de module(s) souhaité(s)
     * @return [table]  : Tableau contenant instance(s) de Module
     */
    public function generate($nb)
    {
      $list_module = [];

      for($i=0;$i<$nb;$i++){
        $modul = new Module();
        $modul->from_random();
        $list_module[] = $modul;
      }
        /*echo '<pre>';
          print_r($list_module);
        echo '</pre>';*/
      return $list_module;
    }

    // STOCK LES INSTANCES de Module SITUES DANS $list_module DANS LA DB
    /**
     * @param  [array]  : Tableau contenant instance(s) de Module
     * @return [nothing]! 
     */
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
    }

    // RECUPERE UN Module DANS LA DB ET RENVOIE UN TABLEAU CONTENANT L'INSTANCE HYDRATEE DE Module
    /**
     * @param  [number] : PK du module souhaité
     * @return [array]  : Tableau associatif avec les paropriétés d'un module
     */
    public function get_single($id)
    {
      $pdo = $this->pdo;

      $prepare = $pdo->prepare("SELECT * FROM modules WHERE id=?");
      $prepare->bindValue(1,$id,PDO::PARAM_INT);
      $prepare->execute();

	  $donnee_module = $prepare->fetch(PDO::FETCH_ASSOC);

      // hydratation
      $list_modules = [];
      $list_modules = $this->hydrate($donnee_module);
      return $list_modules;
    }

    // RECUPERE TOUS LES Module DANS LA DB
    /**
     * @return [array] : Tableau contenant instance(s) hydratée(s) de Module
     */
    public function get_all()
    {
      $pdo = $this->pdo;

      $prepare = $pdo->prepare("SELECT * FROM modules");
      $prepare->execute();

      $donnee_modules = $prepare->fetchAll(PDO::FETCH_ASSOC);

      // hydratation
      $list_modules = [];
      $list_modules = $this->hydrate($donnee_modules);
      return $list_modules;
    }

    // RECUPERE TOUS LES Module ACHETABLE    
    /**
     * @return [array] : Tableau contenant instance(s) hydratée(s) de Module
     */
    public function get_all_buyable()
    {
      $pdo = $this->pdo;

      $prepare = $pdo->prepare("SELECT * FROM modules WHERE team_id IS NULL");
      $prepare->execute();

      $buyable_modules = $prepare->fetchAll(PDO::FETCH_ASSOC);

      // hydratation
      $list_modules = [];
      $list_modules = $this->hydrate($buyable_modules);
      return $list_modules;
    }

    // todo : tester la fonction get_all_by_team_id
    /**
     * @return [array] : Tableau contenant instance(s) hydratée(s) de Module
     */
    public function get_all_by_team(Team $team)
    {

      $pdo = $this->pdo;

      $id = $team->get_id();

      $prepare = $pdo->prepare("SELECT * FROM modules WHERE team_id=?");

      $prepare->bindValue(1,$id,PDO::PARAM_INT).

      $prepare->execute();

      $donnee_modules = $prepare->fetchAll(PDO::FETCH_ASSOC);

      // hydratation
      $list_modules = [];
      $list_modules = $this->hydrate($donnee_modules);
      return $list_modules;
    }


    // Update
    // SUPPRIME L'INSTANCE DE Module DANS LA DB
    /**
     * @param  [Module] : Instance de Module à supprimer
     * @return [nothing]!
     */
    public function delete(Module $module)
    {
      $pdo = $this->pdo;
      $id=$module->get_id();

      $prepare = $pdo->prepare("DELETE FROM modules WHERE id=?");
      $prepare->bindValue(1,$id,PDO::PARAM_INT);
      $prepare->execute();
    }

    // todo : update de la FK (team_id) de module en fonction de Team
    /**
     * @param  [Module] : Instance de Module à modifier
     * @param  [Team]   : Instance de Team à laquel le module appartient
     * @return [nothing]!
     */
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

    /**
     * @param  [array] : Tableau de tableau associatif contenant les propriétés d'un objet
     * @return [array] : Tableau contenant instance(s) hydratée(s) de Module
     */
    private function hydrate(array $list_donnee)
    {
      $list_modules = [];
      foreach ($list_donnee as $key => $donnee) {
        $module = new Module();
        $module->from_db($donnee);
        $list_modules[] = $module;
      }

      return $list_modules;
    }
    // SETTER POUR PDO
    public function set_pdo($pdo)
    {
      $this->pdo = $pdo;
    }
}
<?php 
function store_modules_model($list_module){
    if (!is_array($list_module)) throw new Exception("Merci de renseigner un tableau", 1);
    
    $pdo = get_pdo();

    $nb_mod = count($list_module);

    $requete=("INSERT INTO `modules` (`name`,`price`,`brand`,`type`,`timestamp`,`aerodynamics`,`solidarity`,`cosiness`,`speed`,`shipping`) VALUES ");
    
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
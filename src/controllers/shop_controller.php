<?php 
	function shop_action(){

    	$pdo = get_pdo();
    	$module_manager    = new game\Module_manager($pdo);
    	$equipment_manager = new game\Equipment_manager($pdo);

    	$mod_buyable_list 		= $module_manager->get_all_buyable();
    	$equipment_buyable_list = $equipment_manager->get_all_buyable();
		include '../views/magasin.php' ;
		$_SESSION['message']=NULL;
	}
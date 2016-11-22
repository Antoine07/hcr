<?php 

function buy_module_action(){
	if($_SERVER['REQUEST_METHOD'] == 'POST') // si on est en méthode POST
	{
		$module_id = $_POST['module_id'];
		$pdo = get_pdo();
		$module_manager = new game\Module_manager($pdo);

		$module = $module_manager->get_single($module_id);
		echo '<pre>';
			print_r($module);
		echo '</pre>';
	}
}
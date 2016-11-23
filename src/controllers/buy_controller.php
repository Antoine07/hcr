<?php 

function buy_action(){
	if($_SERVER['REQUEST_METHOD'] == 'POST') // si on est en méthode POST
	{
		// + pour test (création et attribution de la team)
		$test_pdo          = get_pdo();
		$test_team_manager = new game\Team_manager($test_pdo);
		/*$test_new_team = $test_team_manager->create('Sheep_hopoteam');
		$test_team_manager->store($test_new_team);*/

		$test_team = $test_team_manager->get_single(1);
		$_SESSION['user']['team_id'] = $test_team->get_id();
		// Fin du + pour test

		
		$prefix = '/' . getEnv('URL_PREFIX');
		$team_id   = $_SESSION['user']['team_id'];
		$item_id = $_POST['item_id'];
		$item_category = $_POST['item_category'];

		$_SESSION['message'] = NULL;
		$pdo            = get_pdo();

		// Récupération des données
		switch ($item_category) {
			case 'module':
				$item_manager 	= new game\Module_manager($pdo);
				break;
			case 'equipment':
				$item_manager 	= new game\Equipment_manager($pdo);
				break;
			
			default:
				# code...
				break;
		}
		$team_manager   = new game\Team_manager($pdo);
		
		$item = $item_manager->get_single($item_id);
		$team = $team_manager->get_single($team_id);

		$item_p       = $item->get_price();
		$item_team_id = $item->get_team_id();
		$team_c       = $team->get_credit();

		// Traitement des données

		if($item_team_id){
			$_SESSION['message'] = "Trop tard ! Quelqu'un a été plus rapide que vous";
		}
		else
		{
			if ($item_p<=$team_c) {
				$_SESSION['message'] = $item->get_name()." a bien été ajouté à votre inventaire !";

				$new_team_c = $team_c-$item_p;
				$team_id    = $team->get_id();

				$team_manager->update($team,'credit',$new_team_c);
				$item_manager->update($item ,'team_id',$team_id);
			}else{
				$_SESSION['message'] = "Vous n'avez pas assez de crédit !";
				
			}
		}
		header('Location: '.$prefix.'/shop');
		
		/*echo '<pre>';
			print_r($item);
			echo '<hr/><br/>';
			print_r($team);
		echo '</pre>';*/
		//$module_manager->update_team_id($module,$team);
	}
}
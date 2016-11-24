<?php 

function sell_action(){
	if($_SERVER['REQUEST_METHOD'] == 'POST') // si on est en méthode POST
	{	
		$prefix              = '/' . getEnv('URL_PREFIX');
		$team_id             = $_SESSION['user']['team_id'];
		$item_id             = $_POST['item_id'];
		$item_category       = $_POST['item_category'];

		$_SESSION['message'] = NULL;
		$message             = [];
		$pdo                 = get_pdo();

		// Récupération des données
		switch ($item_category) {
			case 'module':
				$item_manager = new game\Module_manager($pdo);
				break;
			case 'equipment':
				$item_manager = new game\Equipment_manager($pdo);
				break;
			default:
				break;
		}
		$team_manager   = new game\Team_manager($pdo);
		
		$item = $item_manager->get_single($item_id);
		$team = $team_manager->get_single($team_id);

		$item_p       = ($item->get_price())/2;
		$item_name	  = $item->get_name(); 
		$item_team_id = $item->get_team_id();
		$team_c       = $team->get_credit();


		$message=$item_name.' a bien été vendu.';

		// Traitement des données
		$_SESSION['message'] = $message;

		$new_team_c = $team_c+$item_p;

		$team_manager->update($team,'credit',$new_team_c);
		$item_manager->update($item ,'team_id','NULL');
		header('Location: '.$prefix.'/shop');
	}
}
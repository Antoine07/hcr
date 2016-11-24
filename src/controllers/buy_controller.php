<?php 

function buy_action(){
	if($_SERVER['REQUEST_METHOD'] == 'POST') // si on est en méthode POST
	{	
		$prefix              = '/' . getEnv('URL_PREFIX');
		$team_id             = $_SESSION['user']['team_id'];
		$item_id             = $_POST['item_id'];
		$item_category       = $_POST['item_category'];

		$_SESSION['message'] = NULL;
		$message             = [];
		$dialogue            = [];
		$pdo                 = get_pdo();

		// Récupération des données
		switch ($item_category) {
			case 'module':
				$item_manager = new game\Module_manager($pdo);
				break;
			case 'equipment':
				$item_manager = new game\Equipment_manager($pdo);
				break;
			case 'NPC':
				$item_manager = new game\NPC_manager($pdo);
				break;
			default:
				break;
		}
		$team_manager   = new game\Team_manager($pdo);
		
		$item = $item_manager->get_single($item_id);
		$team = $team_manager->get_single($team_id);

		$item_p       = $item->get_price();
		$item_name	  = $item->get_name(); 
		$item_team_id = $item->get_team_id();
		$team_c       = $team->get_credit();


		switch ($item_category) {
			case 'module':
			case 'equipment':
				$sufix = '/shop';
				$message = [
				'Trop tard ! Quelqu\'un a été plus rapide que vous',
				$item_name.' a bien été ajouté à votre inventaire !',
				'Vous n\'avez pas assez de crédit !'
				];
				break;

			case 'NPC':
				$sufix = '/bar';
				$race = $item->get_race();
				$message = [
					'Trop tard ! '.$item_name.' est parti pour quelqu\'un d\'autre :',
					$item_name.' fait désormais parti de votre équipe !',
					$item_name.' demande plus de crédit :'
				];
				$dialogue = [
					"humain"=>[	['...'],
							   	['J\'accepte votre proposition !','Affaire conclue !','C\'est un plaisir !'],
							   	['Vous essayez de m\'arnaquer ?!','A ce prix là ? Certainement pas !','Faites vous un peu d\'argent et revenez me voir !','C\'est tout ce que vous avez à me proposer ?','Je vaux bien plus que cela...']
							  ],

					"robot"=>[	['...'],
							   	[$item_name.' lance le protocole d\'acceptation.',$item_name.' accepte : transfert de crédits en cours...',$item_name.' initie le déplacement vert nouveau QG...','Mise en quarantaine du statut chaumeur.',$item_name.' ajoute les membres de '.$team->get_name().' dans liste amis'],
							   	[$item_name.' détecte que: offre inférieur à la demande...','Changement de statut : Outré !','Protocole de refus engagé...',$item_name.' Détecte une tentative de négociation abusive !']
							 ],

					"alien"=>[	['...'],
							   	['Nenu anan\'dam to gaman\'nin\'candi.','Ku peak k\'nta l\'tow.','An dam a\'lk nam.'],
							   	['Lok numa t\'sani mokmok...','Ku jaxum '.$item->get_price().' !!! Mok\'nolok !','Tr\'ik dnte anan fe\'ce !','Moks\'tu nach\'al muluk... Neko da ?','Drabno anan\'dam k\'tana d\'han kuh']
							 ]
				];
				$message[0].="<br/>"."`` ".$dialogue[$race][0][0]." ``";
				$message[1].="<br/>"."`` ".$dialogue[$race][1][array_rand($dialogue[$race][1])]." ``";
				$message[2].="<br/>"."`` ".$dialogue[$race][2][array_rand($dialogue[$race][2])]." ``";

				break;
			
			default:
				# code...
				break;
		}

		// Traitement des données

		if($item_team_id){
			print_r($message[1]);
			$_SESSION['message'] = $message[0];

		}
		else
		{
			if ($item_p<=$team_c) {
				$_SESSION['message'] = $message[1];

				$new_team_c = $team_c-$item_p;
				$team_id    = $team->get_id();

				$team_manager->update($team,'credit',$new_team_c);
				$item_manager->update($item ,'team_id',$team_id);
			}else{
				$_SESSION['message'] = $message[2];
				
			}
		}
		header('Location: '.$prefix.$sufix);

	}
}
<?php 
	function race_action(){

		$manager = new game\Race_manager(get_pdo());
		$future_races = $manager->get_future();
		$past_races  = $manager->get_past();
		$team_manager = new game\Team_manager(get_pdo());
		$nom_page = 'Courses';
		include '../views/header_team.php' ;
		include '../views/courses.php' ;
	}
	function participate_action(){

	if($_SERVER['REQUEST_METHOD'] != 'POST') {return;}
	
		$prefix              = '/' . getEnv('URL_PREFIX');
		$message = NULL;
	// PDO
		$pdo = get_pdo();

	// GET RACE_ID AND TEAM_ID
		$team_id = $_SESSION['user']['team_id'];
		$race_id = $_POST['race_id'];
	
	// INSTANCE RACE
		$race_manager = new game\Race_manager($pdo);
		$race = $race_manager->get_single($race_id);

	// INSTANCE TEAM
		$team_manager = new game\Team_manager($pdo);
		$team = $team_manager->get_single($team_id);

		$cost = $race->get_cost();
		$current_credits = $team->get_credit();

	// ON CHECK SI LA TEAM POSSEDE ASSEZ DE CREDITS
		if($current_credits > $cost) {
		// SI OUI
		// ON CHECK SI LA TEAM PEUT PARTICIPER (equipage requis, modules requis)
			if($team_manager->can_participate($team_id)) {
			// SI OUI
			// ON AJOUTE UNE ENTREE DANS LA TABLE race_participants
				$race_manager->add_participant($team_id, $race_id);
			
			// ON RETIRE LES CREDITS A LA TEAM
				$processed_credits = $current_credits - $cost;
				$team_manager->update($team, 'credit', $processed_credits);

			// MESSAGE DE CONFIRMATION
				$message = 'Votre inscription a bien été enregistrée.';
			} else {
				$message = 'Votre équipe ne remplit pas les conditions pour s\'inscrire à la course';
			}
		
		} else {
			$message = 'Vous n\'avez pas assez de crédits pour participer à cette course.';
		}

		$_SESSION['message'] = $message;
		header('Location: '.$prefix.'/race');

	}
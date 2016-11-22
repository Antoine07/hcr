<?php 
	function race_action(){

		$manager = new game\Race_manager(get_pdo());
		$future_races = $manager->get_where('date >= CURDATE()');
		$past_races  = $manager->get_where('date < CURDATE()');

		include '../views/courses.php' ;
	}
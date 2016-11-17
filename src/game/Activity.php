<?php namespace game;
$list_activity = [];

class Activity{
	private $name;
	private $stats;

	function __construct($name, $stats){
		$this ->name  = $name;
		$this ->stats =	$stats;       
	}
}
$list_activity[0] = new Activity('faire des pompes', ['strength'=> 5]);
$list_activity[1] = new Activity('courir', ['stamina'=> 5]);
$list_activity[2] = new Activity('calcul mental', ['intelligence'=> 5]);

    echo '<pre>' ;
    print_r($list_activity);
    echo '</pre>';
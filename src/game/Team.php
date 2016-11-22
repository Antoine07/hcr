<?php namespace game;

class Team {

	use Trait_hydrate;

	private $id = NULL;
	private $name;
	private $pilote = [];
	private $mecanicien = [];
	private $vaisseau;
	private $module = [];
	private $equipement = [];
	private $score;
	private $credit;

	// GETTER
	public function get_id()			{return $this->id;}
	public function get_name()			{return $this->name;}
	public function get_pilote()		{return $this->pilote;}
	public function get_mecanicien()	{return $this->mecanicien;}
	public function get_vaisseau()		{return $this->vaisseau;}
	public function get_module()		{return $this->module;}
	public function get_equipement()	{return $this->equipement;}
	public function get_score()			{return $this->score;}
	public function get_credit()		{return $this->credit;}

	// SETTER
	public function set_id(int $value)				{return $this->id 			= $value;}
	public function set_name(string $value)			{return $this->name 		= $value;}
	public function set_pilote(array $value)		{return $this->pilote 		= $value;}
	public function set_mecanicien(array $value)	{return $this->mecanicien 	= $value;}
	public function set_vaisseau(array $value)		{return $this->vaisseau 	= $value;}
	public function set_module(array $value)		{return $this->module 		= $value;}
	public function set_equipement(array $value)	{return $this->equipement 	= $value;}
	public function set_score(int $value)			{return $this->score 		= $value;}
	public function set_credit(int $value)			{return $this->credit 		= $value;}

	public function from_name($name){
		$this->set_name($name);
		$this->set_credit(1000);
	}

	// HYDRATATION
	public function from_db($data){

		$this->hydrate($data);
	}
}
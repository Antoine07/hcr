<?php namespace game;
 
Trait Trait_hydrate
{
	/**
	 * [hydrate description]
	 * 
	 * @param  array  $data [data to hydrate instance]
	 * @return [type]       [description]
	 */
	public function hydrate(array $data)
	{
		foreach($data as $name => $value)
		{
			$method = 'set_'.$name;
			if(method_exists($this, $method)){
				$this->$method($value);
			}
		}
	}
}
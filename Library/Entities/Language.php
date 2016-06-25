<?php
namespace Library\Entities;

use \Library\Crypt ;

class Language extends \Library\Entity
{
	protected $name;
	
	const NAME_INVALIDE = 1;
  
  // SETTERS //
	
	public function setName($name)
	{
		if (!$this->validator->is_Intitule($name, 1, 150))
		{
			$this->erreurs[] = self::NAME_INVALIDE;
		}
		
		$this->name = $name;
	}
  
  // GETTERS //
  
	public function name()
	{
		return $this->name;
	}
}
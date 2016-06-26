<?php
namespace Library\Entities;

use \Library\Crypt ;

class Language extends \Library\Entity
{
	protected $name,
			  $code;
	
	const NAME_INVALIDE = 1;
	const CODE_INVALIDE = 2;
	
	const CODE_INDISPONIBLE = 100;
  
  // SETTERS //
	
	public function setName($name)
	{
		if (!$this->validator->is_Intitule($name, 1, 150))
		{
			$this->erreurs[] = self::NAME_INVALIDE;
		}
		
		$this->name = $name;
	}
	
	public function setCode($code)
	{
		if (!$this->validator->is_Code_pays($code))
		{
			$this->erreurs[] = self::CODE_INVALIDE;
		}
	
		$this->code = $code;
	}
  
  // GETTERS //
  
	public function name()
	{
		return $this->name;
	}
	
	public function code()
	{
		return $this->code;
	}
}
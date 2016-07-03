<?php
namespace Library\Entities;

use \Library\Crypt ;

class Category extends \Library\Entity
{
	protected $name,
              $id_language,
			  $ordre;
	
	const NAME_INVALIDE = 1;
	const ID_LANGUAGE_INVALIDE = 2;
	const ORDRE_INVALIDE = 3;
	
	const ORDRE_INDISPONIBLE = 100;
  
  // SETTERS //
    
    public function setId_language($id)
	{
		if (!$this->validator->is_Id($id))
		{
			$this->erreurs[] = self::ID_LANGUAGE_INVALIDE;
		}
		
		$this->id_language = $id;
	}
	
	public function setOrdre($order)
	{
		if (!is_int($order) && !ctype_digit($order))
		{
			$this->erreurs[] = self::ORDRE_INVALIDE;
		}
		
		$this->ordre = $order;
	}
	
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
    
    public function id_language()
	{
		return $this->id_language;
	}
	
	public function ordre()
	{
		return $this->ordre;
	}
}
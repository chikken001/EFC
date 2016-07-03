<?php
namespace Library\Entities;

use \Library\Crypt ;

class TypeTraduction extends \Library\Entity
{
	protected $name,
              $id_type,
              $id_language;
	
	const NAME_INVALIDE = 1;
	const ID_LANGUAGE_INVALIDE = 2;
    const ID_TYPE_INVALIDE = 3;
  
  // SETTERS //
    
    public function setId_language($id)
	{
		if (!$this->validator->is_Id($id))
		{
			$this->erreurs[] = self::ID_LANGUAGE_INVALIDE;
		}
		
		$this->id_language = $id;
	}
    
    public function setId_type($id)
	{
		if (!$this->validator->is_Id($id))
		{
			$this->erreurs[] = self::ID_TYPE_INVALIDE;
		}
		
		$this->id_type = $id;
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
    
    public function id_type()
	{
		return $this->id_type;
	}
}
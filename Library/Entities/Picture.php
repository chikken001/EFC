<?php
namespace Library\Entities;

use \Library\Crypt ;

class Picture extends \Library\Entity
{
	protected $name,
              $id_article;
	
	const NAME_INVALIDE = 1;
    const ID_ARTICLE_INVALIDE = 2;
  
  // SETTERS //
  
	public function setName($name)
	{
		if (!$this->validator->is_Intitule($name, 1, 250))
		{
			$this->erreurs[] = self::NAME_INVALIDE;
		}
		
		$this->name = $name;
	}
    
    public function setId_article($id)
	{
		if (!$this->validator->is_Id($id))
		{
			$this->erreurs[] = self::ID_ARTICLE_INVALIDE;
		}
		
		$this->id_article = $id;
	}
  
  // GETTERS //
    
    public function name()
	{
		return $this->name;
	}
    
    public function id_article()
	{
		return $this->id_article;
	}
}
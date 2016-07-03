<?php
namespace Library\Entities;

use \Library\Crypt ;

class Resume extends \Library\Entity
{
	protected $message,
              $id_language,
              $id_article;
	
	const MESSAGE_INVALIDE = 1;
    const ID_LANGUAGE_INVALIDE = 2;
    const ID_ARTICLE_INVALIDE = 3;
  
  // SETTERS //
	
	public function setMessage($message)
	{
		if (!is_string($message))
		{
			$this->erreurs[] = self::MESSAGE_INVALIDE;
		}
		
		$this->message = $message;
	}
    
    public function setId_language($id)
	{
		if (!$this->validator->is_Id($id))
		{
			$this->erreurs[] = self::ID_LANGUAGE_INVALIDE;
		}
		
		$this->id_language = $id;
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
  
	public function message()
	{
		return $this->message;
	}
    
    public function id_language()
	{
		return $this->id_language;
	}
    
    public function id_article()
	{
		return $this->id_article;
	}
}
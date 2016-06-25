<?php
namespace Library\Entities;

use \Library\Crypt ;

class ArticleTraduction extends \Library\Entity
{
	protected $title,
			  $message,
              $id_article,
              $id_language;
	
	const TITLE_INVALIDE = 1;
	const MESSAGE_INVALIDE = 2;
	const ID_ARTICLE_INVALIDE = 3;
    const ID_LANGUAGE_INVALIDE = 4;
  
  // SETTERS //
  
	public function setMessage($message)
	{
		if (!is_string($message) || !is_numeric($message))
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
	
	public function setTitle($titre)
	{
		if (!$this->validator->is_Intitule($titre))
		{
			$this->erreurs[] = self::TITLE_INVALIDE;
		}
		
		$this->title = $titre;
	}
  
  // GETTERS //
  
	public function title()
	{
		return $this->title;
	}
	
	public function message()
	{
		return $this->message;
	}
	
	public function id_article()
	{
		return $this->id_article;
	}
    
    public function id_language()
	{
		return $this->id_language;
	}
}
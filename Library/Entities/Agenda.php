<?php
namespace Library\Entities;

use \Library\Crypt ;

class Agenda extends \Library\Entity
{
	protected $title,
			  $message,
              $created_at,
			  $date,
              $id_language;
	
	const TITLE_INVALIDE = 1;
	const MESSAGE_INVALIDE = 2;
	const CREATED_AT_INVALIDE = 3;
	const DATE_INVALIDE = 4;
    const ID_LANGUAGE_INVALIDE = 5;
  
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
	
	public function setTitle($titre)
	{
		if (!$this->validator->is_Intitule($titre,1,150))
		{
			$this->erreurs[] = self::TITLE_INVALIDE;
		}
		
		$this->title = $titre;
	}
	
	public function setCreated_at($date)
	{
		if(!$this->validator->is_Date($date, 'datetime'))
		{
			$this->erreurs[] = self::CREATED_AT_INVALIDE;
		}
		
		$this->created_at = $date ;
	}
    
    public function setDate($date)
	{
		if(!$this->validator->is_Date($date, 'date'))
		{
			$this->erreurs[] = self::DATE_INVALIDE;
		}
		
		$this->date = $date ;
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
	
	public function date()
	{
		return $this->date;
	}
	
	public function created_at()
	{
		return $this->created_at;
	}
    
    public function id_language()
	{
		return $this->id_language;
	}
}
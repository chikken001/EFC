<?php
namespace Library\Entities;

use \Library\Crypt ;

class ResumeTraduction extends \Library\Entity
{
	protected $message,
              $id_language,
              $id_resume;
	
	const MESSAGE_INVALIDE = 1;
    const ID_LANGUAGE_INVALIDE = 2;
    const ID_RESUME_INVALIDE = 3;
  
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
    
    public function setId_resume($id)
	{
		if (!$this->validator->is_Id($id))
		{
			$this->erreurs[] = self::ID_RESUME_INVALIDE;
		}
		
		$this->id_resume = $id;
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
    
    public function id_resume()
	{
		return $this->id_resume;
	}
}
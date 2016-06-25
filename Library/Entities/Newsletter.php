<?php
namespace Library\Entities;

use \Library\Crypt ;

class Newsletter extends \Library\Entity
{
	protected $name;
	
	const EMAIL_INVALIDE = 1;
    
    const EMAIL_INDISPONIBLE = 100;
  
  // SETTERS //
	
	public function setEmail($mail)
	{
		if (!$this->validator->is_Email($mail))
		{
			$this->erreurs[] = self::EMAIL_INVALIDE;
		}
		
		$this->email = $mail;
	}
  
  // GETTERS //
  
	public function mail()
	{
		return $this->mail;
	}
}
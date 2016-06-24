<?php
namespace Library\Entities;

use \Library\Crypt ;

class User extends \Library\Entity
{
	protected $nom,
			  $prenom,
			  $password,
			  $admin,
			  $date,
			  $salt,
			  $login;
	
	const NOM_INVALIDE = 1;
	const PASSWORD_INVALIDE = 2;
	const ADMIN_INVALIDE = 3;
	const DATE_INVALIDE = 4;
	const PRENOM_INVALIDE = 5;
	const LOGIN_INVALIDE = 6;
	const SALT_INVALIDE = 7;
	
	const LOGIN_INDISPONIBLE = 100;
	const PASSWORD_VERIFICATION = 101;
  
  
  // SETTERS //
  
	public function setNom($nom)
	{
		if (!$this->validator->is_Nom($nom))
		{
			$this->erreurs[] = self::NOM_INVALIDE;
		}
		
		$this->nom = $nom;
	}
	
	public function setPrenom($prenom)
	{
		if (!$this->validator->is_Nom($prenom))
		{
			$this->erreurs[] = self::PRENOM_INVALIDE;
		}
		
		$this->prenom = $prenom;
	}
	
	public function setPassword($password)
	{
		if (!$this->validator->is_Password($password))
		{
			$this->erreurs[] = self::PASSWORD_INVALIDE;
		}
		else
		{
			$this->password = $password;
		}
	}
	
	public function setLogin($login)
	{
		if(!$this->validator->is_Email($login))
		{
			$this->erreurs[] = self::LOGIN_INVALIDE;
		}
		
		$this->login = $login;	
	}
	
	public function setDate($date)
	{
		if(!$this->validator->is_Date($date, 'date'))
		{
			$this->erreurs[] = self::DATE_INVALIDE;
		}
		
		$this->date = $date ;
	}
	
	public function setSalt($salt)
	{
		if(strlen($salt) == 10)
		{
			$this->salt = (string)$salt ;
		}
	}
  
  // GETTERS //
  
	public function nom()
	{
		return $this->nom;
	}
	
	public function prenom()
	{
		return $this->prenom;
	}
	
	public function login()
	{
		return $this->login;
	}
	
	public function salt()
	{
		return $this->salt;
	}
	
	public function password()
	{
		return $this->password;
	}
	
	public function date()
	{
		return $this->date;
	}
}
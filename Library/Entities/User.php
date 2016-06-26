<?php
namespace Library\Entities;

use \Library\Crypt ;

class User extends \Library\Entity
{
	protected $last_name,
			  $first_name,
			  $last_name_ch,
			  $first_name_ch,
			  $password,
			  $admin,
              $active,
              $created_at,
			  $salt,
			  $login;
	
	const FIRST_NAME_INVALIDE = 1;
	const PASSWORD_INVALIDE = 2;
	const ADMIN_INVALIDE = 3;
	const LAST_NAME_INVALIDE = 5;
	const LOGIN_INVALIDE = 6;
	const SALT_INVALIDE = 7;
    const ACTIVE_INVALIDE = 8;
    const CREATED_AT_INVALIDE = 9;
    const FIRST_NAME_CH_INVALIDE = 10;
    const LAST_NAME_CH_INVALIDE = 11;
	
	const PASSWORD_VERIFICATION = 100;
  
  // SETTERS //
  
	public function setFirst_name($prenom)
	{
		if (!$this->validator->is_Nom($prenom))
		{
			$this->erreurs[] = self::FIRST_NAME_INVALIDE;
		}
		
		$this->first_name = $prenom;
	}
	
	public function setLast_name($nom)
	{
		if (!$this->validator->is_Nom($nom))
		{
			$this->erreurs[] = self::LAST_NAME_INVALIDE;
		}
		
		$this->last_name = $nom;
	}
	
	public function setFirst_name_ch($prenom)
	{
		if (!empty($prenom) && !$this->validator->is_Nom($prenom))
		{
			$this->erreurs[] = self::FIRST_NAME_CH_INVALIDE;
		}
	
		$this->first_name_ch = $prenom;
	}
	
	public function setLast_name_ch($nom)
	{
		if (!empty($nom) && !$this->validator->is_Nom($nom))
		{
			$this->erreurs[] = self::LAST_NAME_CH_INVALIDE;
		}
	
		$this->last_name_ch = $nom;
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
		if(!$this->validator->is_Login($login))
		{
			$this->erreurs[] = self::LOGIN_INVALIDE;
		}
		
		$this->login = $login;	
	}
    
    public function setAdmin($admin)
	{
		if(!is_bool($admin) && ($admin != 1 && $admin != 0))
		{
			$this->erreurs[] = self::ADMIN_INVALIDE;
		}
		
		$this->admin = $admin;	
	}
    
    public function setActive($active)
	{
		if(!is_bool($active) && ($active != 1 && $active != 0))
		{
			$this->erreurs[] = self::ADMIN_INVALIDE;
		}
		
		$this->active = $active;	
	}
	
	public function setCreated_at($date)
	{
		if(!$this->validator->is_Date($date, 'date'))
		{
			$this->erreurs[] = self::CREATED_AT_INVALIDE;
		}
		
		$this->created_at = $date ;
	}
	
	public function setSalt($salt)
	{
		if(strlen($salt) == 10)
		{
			$this->salt = (string)$salt ;
		}
	}
  
  // GETTERS //
  
	public function last_name()
	{
		return $this->last_name;
	}
	
	public function first_name()
	{
		return $this->first_name;
	}
	
	public function last_name_ch()
	{
		return $this->last_name_ch;
	}
	
	public function first_name_ch()
	{
		return $this->first_name_ch;
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
    
    public function admin()
	{
		return $this->admin;
	}
    
    public function active()
	{
		return $this->active;
	}
	
	public function created_at()
	{
		return $this->created_at;
	}
}
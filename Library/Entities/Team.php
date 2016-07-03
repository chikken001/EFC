<?php
namespace Library\Entities;

use \Library\Crypt ;

class Team extends \Library\Entity
{
	protected $first_name,
			  $first_name_ch,
              $last_name,
			  $last_name_ch,
              $id_category,
              $picture,
              $email;
	
	const FIRST_NAME_INVALIDE = 1;
	const FIRST_NAME_CH_INVALIDE = 2;
	const LAST_NAME_INVALIDE = 3;
	const LAST_NAME_CH_INVALIDE = 4;
    const ID_CATEGORY_INVALIDE = 5;
    const EMAIL_INVALIDE = 6;
    const PICTURE_INVALIDE = 7;
  
  // SETTERS //
    
    public function setId_category($id)
	{
		if (!$this->validator->is_Id($id))
		{
			$this->erreurs[] = self::ID_CATEGORY_INVALIDE;
		}
		
		$this->id_category = $id;
	}
    
    public function setEmail($mail)
	{
		if (!$this->validator->is_Email($mail))
		{
			$this->erreurs[] = self::EMAIL_INVALIDE;
		}
		
		$this->email = $mail;
	}
	
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
		if (!$this->validator->is_Nom($prenom))
		{
			$this->erreurs[] = self::FIRST_NAME_CH_INVALIDE;
		}
		
		$this->first_name_ch = $prenom;
	}
	
	public function setLast_name_ch($nom)
	{
		if (!$this->validator->is_Nom($nom))
		{
			$this->erreurs[] = self::LAST_NAME_CH_INVALIDE;
		}
		
		$this->last_name_ch = $nom;
	}
	
	public function setPicture($name)
	{
		if (!$this->validator->is_Intitule($name, 4, 250))
		{
			$this->erreurs[] = self::PICTURE_INVALIDE;
		}
	
		$this->picture = $name;
	}
  
  // GETTERS //
  
	public function email()
	{
		return $this->email;
	}
	
	public function picture()
	{
		return $this->picture;
	}
    
    public function id_category()
	{
		return $this->id_category;
	}
	
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
}
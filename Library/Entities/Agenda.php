<?php
namespace Library\Entities;

use \Library\Crypt ;

class Agenda extends \Library\Entity
{
	protected $title,
			  $message,
              $created_at,
			  $date,
              $id_language,
			  $place,
			  $city,
			  $postal_code,
			  $address,
			  $id_type;
	
	const TITLE_INVALIDE = 1;
	const MESSAGE_INVALIDE = 2;
	const CREATED_AT_INVALIDE = 3;
	const DATE_INVALIDE = 4;
    const ID_LANGUAGE_INVALIDE = 5;
	const POSTAL_CODE_INVALIDE = 6;
	const PLACE_INVALIDE = 7;
	const CITY_INVALIDE = 9;
	const ADDRESS_INVALIDE = 11;
	const ID_TYPE_INVALIDE = 12;
  
  // SETTERS //
  
	public function setMessage($message)
	{
		if (!is_string($message) || !is_numeric($message))
		{
			$this->erreurs[] = self::MESSAGE_INVALIDE;
		}
		
		$this->message = $message;
	}
	
	public function setAddress($address)
	{
		if (!is_string($address) || !is_numeric($address))
		{
			$this->erreurs[] = self::ADDRESS_INVALIDE;
		}
		
		$this->address = $address;
	}
	
	public function setPostal_code($code)
	{
		if (!$this->validator->is_Code_postal($code))
		{
			$this->erreurs[] = self::POSTAL_CODE_INVALIDE;
		}
		
		$this->code = $code;
	}
    
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
	
	public function setTitle($titre)
	{
		if (!$this->validator->is_Intitule($titre,1,150))
		{
			$this->erreurs[] = self::TITLE_INVALIDE;
		}
		
		$this->title = $titre;
	}
	
	public function setPlace($place)
	{
		if (!$this->validator->is_Intitule($place,1,150))
		{
			$this->erreurs[] = self::PLACE_INVALIDE;
		}
		
		$this->place = $place;
	}
	
	public function setCity($city)
	{
		if (!$this->validator->is_Intitule($city,1,150))
		{
			$this->erreurs[] = self::CITY_INVALIDE;
		}
		
		$this->city = $city;
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
	
	public function id_type()
	{
		return $this->id_type;
	}
	
	public function place()
	{
		return $this->place;
	}
	
	public function city()
	{
		return $this->place;
	}
	
	public function address()
	{
		return $this->address;
	}
	
	public function postal_code()
	{
		return $this->postal_code;
	}
}
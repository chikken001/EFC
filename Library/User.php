<?php
namespace Library;

use \Library\Crypt ;

class User extends ApplicationComponent
{
	protected $language_codes = array(
        'en' => 'English' , 
        'aa' => 'Afar' , 
        'ab' => 'Abkhazian' , 
        'af' => 'Afrikaans' , 
        'am' => 'Amharic' , 
        'ar' => 'Arabic' , 
        'as' => 'Assamese' , 
        'ay' => 'Aymara' , 
        'az' => 'Azerbaijani' , 
        'ba' => 'Bashkir' , 
        'be' => 'Byelorussian' , 
        'bg' => 'Bulgarian' , 
        'bh' => 'Bihari' , 
        'bi' => 'Bislama' , 
        'bn' => 'Bengali/Bangla' , 
        'bo' => 'Tibetan' , 
        'br' => 'Breton' , 
        'ca' => 'Catalan' , 
        'co' => 'Corsican' , 
        'cs' => 'Czech' , 
        'cy' => 'Welsh' , 
        'da' => 'Danish' , 
        'de' => 'German' , 
        'dz' => 'Bhutani' , 
        'el' => 'Greek' , 
        'eo' => 'Esperanto' , 
        'es' => 'Spanish' , 
        'et' => 'Estonian' , 
        'eu' => 'Basque' , 
        'fa' => 'Persian' , 
        'fi' => 'Finnish' , 
        'fj' => 'Fiji' , 
        'fo' => 'Faeroese' , 
        'fr' => 'French' , 
        'fy' => 'Frisian' , 
        'ga' => 'Irish' , 
        'gd' => 'Scots/Gaelic' , 
        'gl' => 'Galician' , 
        'gn' => 'Guarani' , 
        'gu' => 'Gujarati' , 
        'ha' => 'Hausa' , 
        'hi' => 'Hindi' , 
        'hr' => 'Croatian' , 
        'hu' => 'Hungarian' , 
        'hy' => 'Armenian' , 
        'ia' => 'Interlingua' , 
        'ie' => 'Interlingue' , 
        'ik' => 'Inupiak' , 
        'in' => 'Indonesian' , 
        'is' => 'Icelandic' , 
        'it' => 'Italian' , 
        'iw' => 'Hebrew' , 
        'ja' => 'Japanese' , 
        'ji' => 'Yiddish' , 
        'jw' => 'Javanese' , 
        'ka' => 'Georgian' , 
        'kk' => 'Kazakh' , 
        'kl' => 'Greenlandic' , 
        'km' => 'Cambodian' , 
        'kn' => 'Kannada' , 
        'ko' => 'Korean' , 
        'ks' => 'Kashmiri' , 
        'ku' => 'Kurdish' , 
        'ky' => 'Kirghiz' , 
        'la' => 'Latin' , 
        'ln' => 'Lingala' , 
        'lo' => 'Laothian' , 
        'lt' => 'Lithuanian' , 
        'lv' => 'Latvian/Lettish' , 
        'mg' => 'Malagasy' , 
        'mi' => 'Maori' , 
        'mk' => 'Macedonian' , 
        'ml' => 'Malayalam' , 
        'mn' => 'Mongolian' , 
        'mo' => 'Moldavian' , 
        'mr' => 'Marathi' , 
        'ms' => 'Malay' , 
        'mt' => 'Maltese' , 
        'my' => 'Burmese' , 
        'na' => 'Nauru' , 
        'ne' => 'Nepali' , 
        'nl' => 'Dutch' , 
        'no' => 'Norwegian' , 
        'oc' => 'Occitan' , 
        'om' => '(Afan)/Oromoor/Oriya' , 
        'pa' => 'Punjabi' , 
        'pl' => 'Polish' , 
        'ps' => 'Pashto/Pushto' , 
        'pt' => 'Portuguese' , 
        'qu' => 'Quechua' , 
        'rm' => 'Rhaeto-Romance' , 
        'rn' => 'Kirundi' , 
        'ro' => 'Romanian' , 
        'ru' => 'Russian' , 
        'rw' => 'Kinyarwanda' , 
        'sa' => 'Sanskrit' , 
        'sd' => 'Sindhi' , 
        'sg' => 'Sangro' , 
        'sh' => 'Serbo-Croatian' , 
        'si' => 'Singhalese' , 
        'sk' => 'Slovak' , 
        'sl' => 'Slovenian' , 
        'sm' => 'Samoan' , 
        'sn' => 'Shona' , 
        'so' => 'Somali' , 
        'sq' => 'Albanian' , 
        'sr' => 'Serbian' , 
        'ss' => 'Siswati' , 
        'st' => 'Sesotho' , 
        'su' => 'Sundanese' , 
        'sv' => 'Swedish' , 
        'sw' => 'Swahili' , 
        'ta' => 'Tamil' , 
        'te' => 'Tegulu' , 
        'tg' => 'Tajik' , 
        'th' => 'Thai' , 
        'ti' => 'Tigrinya' , 
        'tk' => 'Turkmen' , 
        'tl' => 'Tagalog' , 
        'tn' => 'Setswana' , 
        'to' => 'Tonga' , 
        'tr' => 'Turkish' , 
        'ts' => 'Tsonga' , 
        'tt' => 'Tatar' , 
        'tw' => 'Twi' , 
        'uk' => 'Ukrainian' , 
        'ur' => 'Urdu' , 
        'uz' => 'Uzbek' , 
        'vi' => 'Vietnamese' , 
        'vo' => 'Volapuk' , 
        'wo' => 'Wolof' , 
        'xh' => 'Xhosa' , 
        'yo' => 'Yoruba' , 
        'zh' => 'Chinese' , 
        'zu' => 'Zulu' , 
    );
	
	public function getAttribute($attr)
	{
		return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
	}
	
	public function setAttribute($attr, $value)
	{
		$_SESSION[$attr] = $value;
	}
	
	public function deleteAttribute($attr)
	{
		if(isset($_SESSION[$attr]))
		{
			unset($_SESSION[$attr]) ;
		}
	}
	
	public function getFlash()
	{
		$flash = $_SESSION['flash'];
		unset($_SESSION['flash']);
		
		return $flash;
	}
	
	public function key()
	{
		if(isset($_SESSION['key']))
		{ 
			return $_SESSION['key'] ;
		}
		
		return false ;
	}
	
	public function setKey()
	{
		if(!isset($_SESSION['key']))
		{
			$crypt = new Crypt ;
			$key = substr($crypt->salt(), 0 , 8) ;
			$_SESSION['key'] = $key ; 
		}
	}
	
	public function hasFlash()
	{
		return isset($_SESSION['flash']);
	}
	
	public function getLanguage()
	{
		if(isset($_SESSION['lang'])) 
		{
			return $_SESSION['lang'] ;
		}
		else
		{
			$_SESSION['lang'] = "fr" ;
			return 'fr' ;
		}
	}
	
	public function setLanguage($lang = '')
	{
		if(!empty($lang) && isset($this->language_codes[$lang]))
		{
			$_SESSION['lang'] = $lang ;
			return true ;
		}
		elseif(empty($lang) && !isset($_SESSION['lang'])) 
		{
			$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) ;
			$_SESSION['lang'] = $lang ;
			return true ;
		}
		
		return false ;
	}
	
	public function isAuthenticated()
	{
		return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
	}
	
	public function isAdmin()
	{
		return isset($_SESSION['auth']) && $_SESSION['auth'] === true && isset($_SESSION['statut']) && $_SESSION['statut'] === 'Admin';
	}
	
	public function setAuthenticated($authenticated = true, $statut = false)
	{
		if (!is_bool($authenticated) || (!is_bool($statut) && !is_string($statut)))
		{
			throw new \InvalidArgumentException('Les valeurs specifiees a la methode User::setAuthenticated() doivent etre valide');
		}
		
		if($statut === 'Admin')
		{
			$_SESSION['statut'] = $statut;
		}
		
		$_SESSION['auth'] = $authenticated;
	}
	
	public function setFlash($value)
	{
		$_SESSION['flash'] = $value;
	}
	
	public function generateToken($nom)
	{
		$token = uniqid(rand(), true);
		$_SESSION[$nom.'_token'] = $token;
		$_SESSION[$nom.'_token_time'] = time();
		return $token;
	}
	
	public function isValidToken($temps, $referer, $nom)
	{
		if(isset($_SESSION[$nom.'_token']) && isset($_SESSION[$nom.'_token_time']) && isset($_POST['token']))
		{
			if($_SESSION[$nom.'_token'] == $_POST['token'])
			{
				if($_SESSION[$nom.'_token_time'] >= (time() - $temps))
				{
					if($_SERVER['HTTP_REFERER'] == $referer)
					{
						return true;
					}
				}
			}
		}
		return false;
	}
}
<?php
namespace Library\Models;

use \Library\Entities\Language;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class LanguageManager_PDO extends LanguageManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
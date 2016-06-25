<?php
namespace Library\Models;

use \Library\Entities\Tag;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class TagManager_PDO extends TagManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
<?php
namespace Library\Models;

use \Library\Entities\TagTraduction;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class TagTraductionManager_PDO extends TagTraductionManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
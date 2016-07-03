<?php
namespace Library\Models;

use \Library\Entities\TypeTraduction;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class TypeTraductionManager_PDO extends TypeTraductionManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
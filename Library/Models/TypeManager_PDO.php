<?php
namespace Library\Models;

use \Library\Entities\Type;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class TypeManager_PDO extends TypeManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
<?php
namespace Library\Models;

use \Library\Entities\CategoryTraduction;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class CategoryTraductionManager_PDO extends CategoryTraductionManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
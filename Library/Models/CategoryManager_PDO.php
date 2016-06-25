<?php
namespace Library\Models;

use \Library\Entities\Category;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class CategoryManager_PDO extends CategoryManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
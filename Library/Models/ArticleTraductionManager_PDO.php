<?php
namespace Library\Models;

use \Library\Entities\ArticleTraduction;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class ArticleTraductionManager_PDO extends ArticleTraductionManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
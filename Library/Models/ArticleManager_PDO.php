<?php
namespace Library\Models;

use \Library\Entities\Article;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class ArticleManager_PDO extends ArticleManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
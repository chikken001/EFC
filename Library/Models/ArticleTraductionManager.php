<?php
namespace Library\Models;

use \Library\Entities\ArticleTraduction;

abstract class ArticleTraductionManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'articletraduction';
	}
}
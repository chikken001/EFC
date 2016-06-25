<?php
namespace Library\Models;

use \Library\Entities\CategoryTraduction;

abstract class CategoryTraductionManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'categorytraduction';
	}
}
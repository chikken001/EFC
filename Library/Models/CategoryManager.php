<?php
namespace Library\Models;

use \Library\Entities\Category;

abstract class CategoryManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'category';
	}
}
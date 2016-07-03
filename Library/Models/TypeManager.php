<?php
namespace Library\Models;

use \Library\Entities\Type;

abstract class TypeManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'type';
	}
}
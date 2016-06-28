<?php
namespace Library\Models;

use \Library\Entities\TagTraduction;

abstract class TagTraductionManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'tagtraduction';
	}
}
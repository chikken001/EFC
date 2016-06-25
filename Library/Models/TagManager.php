<?php
namespace Library\Models;

use \Library\Entities\Tag;

abstract class TagManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'tag';
	}
}
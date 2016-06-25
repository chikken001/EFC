<?php
namespace Library\Models;

use \Library\Entities\Picture;

abstract class PictureManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'picture';
	}
}
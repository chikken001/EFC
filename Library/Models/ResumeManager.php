<?php
namespace Library\Models;

use \Library\Entities\Resume;

abstract class ResumeManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'resume';
	}
}
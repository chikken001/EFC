<?php
namespace Library\Models;

use \Library\Entities\Job;

abstract class JobManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'job';
	}
}
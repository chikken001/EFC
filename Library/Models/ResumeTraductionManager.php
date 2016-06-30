<?php
namespace Library\Models;

use \Library\Entities\ResumeTraduction;

abstract class ResumeTraductionManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'resumetraduction';
	}
}
<?php
namespace Library\Models;

use \Library\Entities\Team;

abstract class TeamManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'team';
	}
}
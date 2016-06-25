<?php
namespace Library\Models;

use \Library\Entities\AgendaTraduction;

abstract class AgendaTraductionManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'agendatraduction';
	}
}
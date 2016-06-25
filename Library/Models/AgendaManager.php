<?php
namespace Library\Models;

use \Library\Entities\Agenda;

abstract class AgendaManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'agenda';
	}
}
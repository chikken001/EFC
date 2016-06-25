<?php
namespace Library\Models;

use \Library\Entities\Agenda;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class AgendaManager_PDO extends AgendaManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
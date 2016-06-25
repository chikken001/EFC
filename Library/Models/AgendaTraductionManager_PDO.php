<?php
namespace Library\Models;

use \Library\Entities\AgendaTraduction;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class AgendaTraductionManager_PDO extends AgendaTraductionManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
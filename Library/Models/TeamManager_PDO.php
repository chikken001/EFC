<?php
namespace Library\Models;

use \Library\Entities\Team;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class TeamManager_PDO extends TeamManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
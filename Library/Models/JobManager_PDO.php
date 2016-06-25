<?php
namespace Library\Models;

use \Library\Entities\Job;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class JobManager_PDO extends JobManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
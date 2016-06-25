<?php
namespace Library\Models;

use \Library\Entities\JobTraduction;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class JobTraductionManager_PDO extends JobTraductionManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
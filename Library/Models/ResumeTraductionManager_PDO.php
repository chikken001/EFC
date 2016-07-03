<?php
namespace Library\Models;

use \Library\Entities\ResumeTraduction;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class ResumeTraductionManager_PDO extends ResumeTraductionManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
<?php
namespace Library\Models;

use \Library\Entities\Resume;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class ResumeManager_PDO extends ResumeManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
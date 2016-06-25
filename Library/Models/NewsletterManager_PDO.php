<?php
namespace Library\Models;

use \Library\Entities\Newsletter;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class NewsletterManager_PDO extends NewsletterManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
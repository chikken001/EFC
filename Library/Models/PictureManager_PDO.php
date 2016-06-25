<?php
namespace Library\Models;

use \Library\Entities\Picture;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class PictureManager_PDO extends PictureManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
}
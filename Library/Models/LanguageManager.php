<?php
namespace Library\Models;

use \Library\Entities\Language;

abstract class LanguageManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'language';
	}
}
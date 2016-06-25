<?php
namespace Library\Models;

use \Library\Entities\Newsletter;

abstract class NewsletterManager extends \Library\Manager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		
		$this->entity_database = PREFIX_TABLE.'newsletter';
	}
}
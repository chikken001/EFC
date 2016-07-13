<?php
namespace Applications\Backend;
class BackendApplication extends \Library\Application
{
	public function __construct()
	{
		parent::__construct();
		
		$this->name = 'Backend';
	}
	
	public function run()
	{
		parent::run();
	}
}
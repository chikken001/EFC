<?php
namespace Applications\Frontend;

class FrontendApplication extends \Library\Application
{
	public function __construct()
	{
		parent::__construct();
		
		$this->name = 'Frontend';
	}
	
	public function run()
	{	
		parent::run();
	}
}
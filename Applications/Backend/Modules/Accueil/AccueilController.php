<?php
namespace Applications\Backend\Modules\Accueil;

class AccueilController extends \Library\BackController
{
	public function __construct($app, $module, $action)
	{
		parent::__construct($app, $module, $action);
			
		if(!$this->user->isAdmin())
		{
			$this->app->httpResponse()->redirect('/admin/connexion');
		}
	}
	
	public function executeIndex(\Library\HTTPRequest $request)
	{
		$this->page->addVar('title', 'Administration');
	}
	
	public function executeRedirect500(\Library\HTTPRequest $request)
	{
		$this->app->httpResponse()->redirectError('500');
	}
}
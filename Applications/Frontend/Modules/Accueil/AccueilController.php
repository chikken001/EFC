<?php
namespace Applications\Frontend\Modules\Accueil;

class AccueilController extends \Library\BackController
{
	public function executeIndex(\Library\HTTPRequest $request)
	{
		$this->page->addVar('title', 'Accueil');
	}
	
	public function executeRedirect500(\Library\HTTPRequest $request)
	{
		$this->app->httpResponse()->redirectError('500');
	}
}
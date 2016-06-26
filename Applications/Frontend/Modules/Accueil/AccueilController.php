<?php
namespace Applications\Frontend\Modules\Accueil;

class AccueilController extends \Library\BackController
{
	public function executeIndex(\Library\HTTPRequest $request)
	{
		$this->page->addVar('title', 'Accueil');
	}
	
	public function executeLanguage(\Library\HTTPRequest $request)
	{
		$id_language = $request->getData('id_language') ;
		$language = $this->em('Language')->DEF->getUnique($id_language) ;
		
		if($language)
		{
			$set = $this->user->setLanguage($language->code()) ;

			$adresse = $this->app()->config()->getGlobal('site') ;
			
			if(isset($_SERVER['HTTP_REFERER']) && preg_match("($adresse)", $_SERVER['HTTP_REFERER']))
			{
				$referer = str_replace($adresse, "", $_SERVER['HTTP_REFERER']);
				$this->app->httpResponse()->redirect($referer);
			}
		}
		
		$this->app->httpResponse()->redirect("/");
	}
	
	public function executeRedirect500(\Library\HTTPRequest $request)
	{
		$this->app->httpResponse()->redirectError('500');
	}
}
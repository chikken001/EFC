<?php
namespace Applications\Frontend\Modules\Accueil;

use \Library\Validator ;
use \Library\Entities\Newsletter;

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
	
	public function executeNewsletter(\Library\HTTPRequest $request)
	{
		$validator = new Validator() ;
		
		if ($request->postExists('newsletter'))
		{
			$email = $request->postData('newsletter') ;
			
			if($validator->is_Email($email))
			{
				$exist = $this->em('Newsletter')->DEF->getUnique(array('email' => $email)) ;
				
				if(!$exist)
				{
					$newsletter = new Newsletter() ;
					$newsletter->setEmail($email) ;
					
					$this->em('Newsletter')->DEF->save($newsletter) ;
				}
				else
				{
					$this->user->setFlash('Vous êtes déjà inscrit à la newletter') ;
				}
			}
			else 
			{
				$this->user->setFlash('Email invalide') ;
			}
		}
	}
	
	public function executeRedirect500(\Library\HTTPRequest $request)
	{
		$this->app->httpResponse()->redirectError('500');
	}
}
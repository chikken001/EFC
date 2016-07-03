<?php
namespace Applications\Frontend\Modules\Accueil;

use Library\Entities\Article ;
use \Library\Validator ;
use \Library\Entities\Newsletter;

class AccueilController extends \Library\BackController
{
	public function executeIndex(\Library\HTTPRequest $request)
	{
		$this->page->addVar('title', 'Accueil');
		
		$id_lang = $this->getIdLanguage() ;
		
		$Articles = $this->em('Article')->getRandom($id_lang, 3) ;
		$articles = array() ;
		
		foreach($Articles as $article)
		{
			$id_language = $article->id_language() ;
			$id_article = $article->id() ;
			 
			$articles[$id_article]['created_at'] = $article->created_at() ;
			$articles[$id_article]['picture'] = $this->getPicturePath($article) ;
			$articles[$id_article]['author'] = $this->getFormatAuthor($id_lang, $article->id_user()) ;
			 
			if($id_lang == $id_language)
			{
				$articles[$id_article]['title'] = $article->title() ;
				$articles[$id_article]['message'] = substr($article->message(), 0, 75) ;
			}
			else
			{
				$traduction = $this->em('ArticleTraduction')->DEF->getUnique(array('id_article' => $id_article, 'id_language' => $id_lang)) ;
				$articles[$id_article]['title'] = $traduction->title() ;
				$articles[$id_article]['message'] = substr($traduction->message(), 0, 75) ;
			}
		}
		
		$this->page->addVar('articles', $articles);
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
	
	protected function getIdLanguage()
	{
		$lang = $this->user->getLanguage() ;
		$language = $this->em('Language')->DEF->getUnique(array('code' => $lang)) ;
		$language ? $id_lang = $language->id() : $id_lang = 3 ;
	
		return $id_lang ;
	}
	
	protected function getFormatAuthor($id_lang, $id_user)
	{
		$auteur = $this->em('User')->DEF->getUnique($id_user) ;
	
		if($id_lang == 1 && !empty($auteur->first_name_ch()))
		{
			$nom_auteur = $auteur->first_name_ch() ;
	
			if(!empty($auteur->last_name_ch())) $nom_auteur = $nom_auteur.' '.$auteur->last_name_ch() ;
	
			return $nom_auteur ;
		}
		else
		{
			return $auteur->first_name().' '.$auteur->last_name() ;
		}
	}
	
	protected function getPicturePath($entity)
	{
		$entity instanceof Article ? $picture = $entity->picture() : $entity->name() ;
	
		$path = $_SERVER["DOCUMENT_ROOT"].PICTURE_FOLDER ;
	
		return (!empty($picture) && file_exists($path.$picture)) ? PICTURE_FOLDER.$picture : PICTURE_FOLDER.'default.png' ;
	}
	
	public function executeRedirect500(\Library\HTTPRequest $request)
	{
		$this->app->httpResponse()->redirectError('500');
	}
}
<?php
namespace Applications\Frontend\Modules\Test;

class TestController extends \Library\BackController
{
	public function executeTrad(\Library\HTTPRequest $request)
	{
		$this->page->addVar('title', 'Test');
		
		$lang = $this->user->getLanguage() ;
		$language = $this->em('Language')->DEF->getUnique(array('code' => $lang)) ;
		
		$language ? $id_lang = $language->id() : $id_lang = 3 ;
		$Articles = $this->em('Article')->getByLanguage($id_lang, 0, 2) ;
		$articles = array() ;
		
		foreach($Articles as $article)
		{
			$id_language = $article->id_language() ;
			$id_article = $article->id() ;
			
			$articles[$id_article]['created_at'] = $article->created_at() ;
			$articles[$id_article]['picture'] = $article->picture() ;
			
			$auteur = $this->em('User')->DEF->getUnique($article->id_user()) ;
			
			if($id_lang == 1 && !empty($auteur->first_name_ch()))
			{
				$nom_auteur = $auteur->first_name_ch() ;
				
				if(!empty($auteur->last_name_ch())) $nom_auteur = $nom_auteur.' '.$auteur->last_name_ch() ;	
				
				$articles[$id_article]['author'] = $nom_auteur ;
			}
			else 
			{
				$articles[$id_article]['author'] = $auteur->first_name().' '.$auteur->last_name() ;
			}
		
			if($id_lang == $id_language)
			{
				$articles[$id_article]['title'] = $article->title() ;
				$articles[$id_article]['message'] = $article->message() ;
			}
			else 
			{
				$traduction = $this->em('ArticleTraduction')->DEF->getUnique(array('id_article' => $id_article, 'id_language' => $id_lang)) ;
				$articles[$id_article]['title'] = $traduction->title() ;
				$articles[$id_article]['message'] = $traduction->message() ;
			}
		}
		
		var_dump($articles, $id_lang) ;
	}
}
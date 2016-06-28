<?php
namespace Applications\Frontend\Modules\Article;

class ArticleController extends \Library\BackController
{
	public function executeShow(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', 'Article');
	}
    
    public function executeList(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', 'Articles');
        
        $lang = $this->user->getLanguage() ;
        $language = $this->em('Language')->DEF->getUnique(array('code' => $lang)) ;
        
        $language ? $id_lang = $language->id() : $id_lang = 3 ;

		$request->getExists('page') ? $page = substr($request->getExists('page'), 1) : $page = 1 ;
		
		$max_page = 1 ;
		
		$search_tag = '' ;
		$search_date = '' ;
		$search = '' ;
		
		if($request->getExists('search') && !empty($request->getData('search')))
		{
			$search = $request->getData('search');
			$this->page->addVar('search', $search);
		}
		
		if($request->getExists('date') && !empty($request->getData('date')))
		{
			$search_date = $request->getData('date');
			$this->page->addVar('search_date', $search);
		}
		
		if($request->getExists('tag') && !empty($request->getData('tag')))
		{
			$search_tag = $request->getData('tag');
			$this->page->addVar('search_tag', $search);
		}
		
		$nb_articles =  $this->em('Article')->countSearch($id_lang, $search, $search_date, $search_tag) ;
		
		$limit = 6 ;
		
		if($nb_articles > 0)
		{
			$nb_page = 0 ;
				
			for($i = 0, $j = 0 ; $i < $nb_articles ; $i ++)
			{
				$j++ ;
		
				if($j == $limit)
				{
					$nb_page ++ ;
					$j = 0 ;
				}
			}
				
			if($j != 0) $nb_page ++ ;
				
			$max_page = $nb_page ;
		}
		
		if($page > $max_page) $page = $max_page ;
		
		$offset = ($page - 1) * $limit ;
		
		$Articles = $this->em('Article')->search($id_lang, $search, $search_date, $search_tag) ;
		
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

		$this->page->addVar('page', $page);
		$this->page->addVar('max_page', $max_page);
		$this->page->addVar('articles', $articles);
	}
}
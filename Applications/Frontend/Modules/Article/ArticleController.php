<?php
namespace Applications\Frontend\Modules\Article;
use Library\Entities\Article ;

class ArticleController extends \Library\BackController
{
	public function executeShow(\Library\HTTPRequest $request)
	{
		$id_article = $request->getData('id_article') ;
		$Article = $this->em('Article')->DEF->getUnique($id_article) ;
		
        if($Article)
        {
        	$article = array() ;
        	$pictures = array() ;
        	$similars = array() ;
        	$empty = '' ;
        	
        	$id_lang = $this->getIdLanguage() ;
        	$id_language = $Article->id_language() ;
        	
        	if($id_lang == $id_language)
        	{
        		$article['title'] = $Article->title() ;
        		$article['message'] = $Article->message() ;
        	}
        	else 
        	{	
        		$traduction = $this->em('ArticleTraduction')->DEF->getUnique(array('id_article' => $id_article, 'id_language' => $id_lang)) ;
        		
        		if($traduction)
        		{
        			$article['title'] = $traduction->title() ;
        			$article['message'] = $traduction->message() ;
        		}
        		else 
        		{
        			$no_traduction = array(1 => '有一个在你的语言中没有翻译这篇文章', 2 => "Il n'y a aucune traduction dans votre langue pour cet article", 3 => 'There is no translation in your language for this article');
        			isset($no_traduction[$id_lang]) ? $empty = $no_traduction[$id_lang] : $empty = $no_traduction[3] ;
        		}
        	}
        	
        	if(!empty($article))
        	{
        		$article['created_at'] = $Article->created_at() ;
        		$article['author'] = $this->getFormatAuthor($id_lang, $Article->id_user()) ;
        		$article['picture'] = $this->getPicturePath($Article) ;
        		
        		$Pictures = $this->em('Article')->getPictures($id_article) ;
        		
        		foreach($Pictures as $picture)
        		{
        			$pictures[] = $this->getPicturePath($picture) ;
        		}
        		
        		$Similars = $this->em('Article')->getSimilars($id_article, $id_lang, 1) ;
        		
        		foreach($Similars as $similar)
        		{
        			$id_language = $similar->id_language() ;
        			$id_similar = $similar->id() ;
        			
        			$similars[$id_similar]['created_at'] = $similar->created_at() ;
        			$similars[$id_similar]['picture'] = $this->getPicturePath($similar) ;
        			$similars[$id_similar]['author'] = $this->getFormatAuthor($id_lang, $similar->id_user()) ;
        			
        			if($id_lang == $id_language)
        			{
        				$similars[$id_similar]['title'] = $similar->title() ;
        				$similars[$id_similar]['message'] = substr($similar->message(), 0, 75) ;
        			}
        			else
        			{
        				$traduction = $this->em('ArticleTraduction')->DEF->getUnique(array('id_article' => $id_similar, 'id_language' => $id_lang)) ;
        				$similars[$id_similar]['title'] = $traduction->title() ;
        				$similars[$id_similar]['message'] = substr($traduction->message(), 0, 75) ;
        			}
        		}
        	}
        	
        	$this->page->addVar('article', $article);
        	$this->page->addVar('pictures', $pictures);
        	$this->page->addVar('similars', $similars);
        	$this->page->addVar('empty', $empty);
        }
        else
        {
        	$this->app->httpResponse()->redirectError('404');
        }
	}
    
    public function executeList(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', 'Articles');
        
        $id_lang = $this->getIdLanguage() ;

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

		$this->page->addVar('page', $page);
		$this->page->addVar('max_page', $max_page);
		$this->page->addVar('articles', $articles);
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
}
<?php
namespace Library\Models;

use \Library\Entities\Article;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class ArticleManager_PDO extends ArticleManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
	
	public function getByLanguage($id_lang, $offset = -1, $limit = -1)
	{
		$requete = $this->dao->prepare('SELECT a.* FROM '.$this->entity_database.' a
									   left join articletraduction at on a.id = at.id_article
									   where a.id_language = :id_lang or at.id_language = :id_lang
									   group by a.id, a.picture, a.title, a.message, a.created_at, a.id_user, a.id_language
									   limit :limit
									   offset :offset') ;
	
		$requete->bindValue('id_lang', $id_lang, \PDO::PARAM_INT);
		$requete->bindValue('offset', $offset, \PDO::PARAM_INT);
		$requete->bindValue('limit', $limit, \PDO::PARAM_INT);
		
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Article');
	
		$listeArticles = $requete->fetchAll();
	
		$requete->closeCursor();
	
		return $listeArticles ;
	}
	
	public function countSearch($id_lang, $search = '', $date = '', $tag = '')
	{
		$query = "SELECT COUNT(a.id) FROM ".$this->entity_database." a
							 left join articletraduction at on a.id = at.id_article
							 left join article_tag att on att.article = a.id
							 left join tag t on t.id = att.tag
							 left join tagtraduction tt on tt.id_tag = t.id
							 where (a.id_language = :id_lang or at.id_language = :id_lang)" ;
		
		$bind = array(':id_lang' => $id_lang) ;
		
		if(!empty($search) && is_string($search))
		{
			$search = "%$search%" ;
			$query .= " AND (UPPER(a.title) LIKE UPPER(:search) or UPPER(at.title) LIKE UPPER(:search))" ;
			$bind[':search'] = $search ;
		}
	
		if(!empty($date) && is_string($date) && preg_match('/([0-9]{4}-[0-9]{2}-[0-9]{2})/', $date))
		{
			$query .= " AND a.created_at = ':date'" ;
			$bind[':date'] = $date ;
		}
	
		if(!empty($tag) && is_string($tag))
		{
			$tag = "%$tag%" ;
			$query .= " AND (UPPER(t.name) LIKE UPPER(:tag) or UPPER(tt.name) LIKE UPPER(:tag))" ;
			$bind[':tag'] = $tag ;
		}
		
		$query .= '  group by a.id' ;
	
		$requete = $this->dao->prepare($query) ;
		
		foreach ($bind as $nom => $valeur)
		{
			is_int($valeur) ? $param = \PDO::PARAM_INT : $param = \PDO::PARAM_STR ;
			$requete->bindValue($nom, $valeur, $param);
		}
	
		$requete->execute();
	
		$nombre = $requete->fetchColumn() ;
	
		$requete->closeCursor();
	
		return $nombre ;
	}
	
	public function search($id_lang, $search = '', $date = '', $tag = '', $offset = -1, $limit = -1)
	{
		$query = "SELECT a.* FROM ".$this->entity_database." a
							 left join articletraduction at on a.id = at.id_article
							 left join article_tag att on att.article = a.id
							 left join tag t on t.id = att.tag
							 left join tagtraduction tt on tt.id_tag = t.id
							 where (a.id_language = :id_lang or at.id_language = :id_lang)" ;
		
		$offset = intval($offset);
		$limit = intval($limit);
		$id_lang = intval($id_lang);
	
		$bind = array(':id_lang' => $id_lang) ;
	
		if(!empty($search) && is_string($search))
		{
			$search = "%$search%" ;
			$query .= " AND (UPPER(a.title) LIKE UPPER(:search) or UPPER(at.title) LIKE UPPER(:search))" ;
			$bind[':search'] = $search ;
		}
	
		if(!empty($date) && is_string($date) && preg_match('/([0-9]{4}-[0-9]{2}-[0-9]{2})/', $date))
		{
			$query .= " AND a.created_at = ':date'" ;
			$bind[':date'] = $date ;
		}
	
		if(!empty($tag) && is_string($tag))
		{
			$tag = "%$tag%" ;
			$query .= " AND (UPPER(t.name) LIKE UPPER(:tag) or UPPER(tt.name) LIKE UPPER(:tag))" ;
			$bind[':tag'] = $tag ;
		}
	
		$query .= '  group by a.id, a.picture, a.title, a.message, a.created_at, a.id_user, a.id_language' ;
		
		if($offset >= 0  && $limit > 0)
		{
			$query .= ' limit :limit offset :offset' ;
			$bind[':limit'] = $limit ;
			$bind[':offset'] = $offset ;
		}
	
		$requete = $this->dao->prepare($query) ;
	
		foreach ($bind as $nom => $valeur)
		{
			is_int($valeur)  ? $param = \PDO::PARAM_INT : $param = \PDO::PARAM_STR ;
			$requete->bindValue($nom, $valeur, $param);
		}

		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Article');
	
		$listeArticles = $requete->fetchAll();
	
		$requete->closeCursor();
	
		return $listeArticles ;
	}
	
	public function getPictures($id_article)
	{
		$query = 'SELECT * from picture WHERE id_article = :id_article' ;
		
		$requete = $this->dao->prepare($query) ;
		$requete->bindValue('id_article', $id_article, \PDO::PARAM_INT);
		
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Picture');
		
		$listeImages = $requete->fetchAll();
		
		$requete->closeCursor();
		
		return $listeImages ;
	}
	
	public function getSimilars($id_article, $id_lang, $nb)
	{
		$nb = intval($nb) ;
		$listeArticles = array() ;
		
		$query = 'SELECT a.* FROM article a
				  join article_tag at on at.article = a.id
				  join tag t on t.id = at.tag
				  left join articletraduction atr on a.id = atr.id_article
				  WHERE a.id != :id_article AND (a.id_language = :id_lang or atr.id_language = :id_lang)
				  AND t.id IN 
				  (
						SELECT t.id from tag t
					    join article_tag at on at.tag = t.id
						join article a on a.id = at.article
					    WHERE a.id = :id_article
				  )
				  group by a.id, a.picture, a.title, a.message, a.created_at, a.id_user, a.id_language
				  LIMIT 1
				  OFFSET :offset' ;
		
		$count_query = 'SELECT a.id FROM article a
				  join article_tag at on at.article = a.id
				  join tag t on t.id = at.tag
				  left join articletraduction atr on a.id = atr.id_article
				  WHERE a.id != :id_article AND (a.id_language = :id_lang or atr.id_language = :id_lang)
				  AND t.id IN
				  (
						SELECT t.id from tag t
					    join article_tag at on at.tag = t.id
						join article a on a.id = at.article
					    WHERE a.id = :id_article
				  )
				  group by a.id' ;
		
		$requeteCount = $this->dao->prepare($count_query) ;
		$requeteCount->bindValue('id_article', $id_article, \PDO::PARAM_INT);
		$requeteCount->bindValue('id_lang', $id_lang, \PDO::PARAM_INT);

		$requeteCount->execute();
		
		$nb_resultat = $requeteCount->rowCount();
		$requeteCount->closeCursor();

		$result = array() ;
		$i = 1 ;
		$nb_res = $nb_resultat ;
		
		while($nb_res != 0)
		{
			$result[$i] = 1 ;
			$nb_res -- ;
			$i ++ ;
		}
		
		$requete = $this->dao->prepare($query) ;
		
		$i = 0 ;

		while(count($result) > 0 && $i < $nb)
		{
			$rand = rand(1 , $nb_resultat) ;
			
			while(!isset($result[$rand]))
			{
				$rand = rand(1 , $nb_resultat) ;
			}
			
			$offset = $rand - 1 ;

			unset($result[$rand]) ;
			$requete->bindValue('id_article', $id_article, \PDO::PARAM_INT);
			$requete->bindValue('id_lang', $id_lang, \PDO::PARAM_INT);
			$requete->bindValue('offset', $offset, \PDO::PARAM_INT);
			
			$requete->execute();
			$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Article');
			
			$article = $requete->fetch();
			
			$listeArticles[] = $article ;
			$i ++ ;
		}

		$requete->closeCursor();
	
		return $listeArticles ;
	}
	
	public function getRandom($id_lang, $nb)
	{
		$nb = intval($nb) ;
		$listeArticles = array() ;
		
		$count_query = 'SELECT a.id FROM article a
									   left join articletraduction at on a.id = at.id_article
									   where a.id_language = :id_lang or at.id_language = :id_lang
									   group by a.id' ;
		
		$requeteCount = $this->dao->prepare($count_query) ;
		$requeteCount->bindValue('id_lang', $id_lang, \PDO::PARAM_INT);
		
		$requeteCount->execute();
		
		$nb_resultat = $requeteCount->rowCount();
		$requeteCount->closeCursor();
		
		$result = array() ;
		$i = 1 ;
		$nb_res = $nb_resultat ;
		
		while($nb_res != 0)
		{
			$result[$i] = 1 ;
			$nb_res -- ;
			$i ++ ;
		}
		
		$requete = $this->dao->prepare('SELECT a.* FROM article a
									   left join articletraduction at on a.id = at.id_article
									   where a.id_language = :id_lang or at.id_language = :id_lang
									   group by a.id, a.picture, a.title, a.message, a.created_at, a.id_user, a.id_language
									   limit 1
									   offset :offset') ;
		
		$i = 0 ;
		
		while(count($result) > 0 && $i < $nb)
		{
			$rand = rand(1 , $nb_resultat) ;
				
			while(!isset($result[$rand]))
			{
				$rand = rand(1 , $nb_resultat) ;
			}
				
			$offset = $rand - 1 ;
		
			unset($result[$rand]) ;
			$requete->bindValue('id_lang', $id_lang, \PDO::PARAM_INT);
			$requete->bindValue('offset', $offset, \PDO::PARAM_INT);
				
			$requete->execute();
			$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Article');
				
			$article = $requete->fetch();
				
			$listeArticles[] = $article ;
			$i ++ ;
		}
		
		$requete->closeCursor();
		
		return $listeArticles ;
	}
	
	public function getResume($id_article, $id_lang)
	{
		$id_lang = intval($id_lang);
		
		$requete = $this->dao->prepare('SELECT r.* FROM resume r
									   left join resumetraduction rt on r.id = rt.id_resume
									   where (r.id_language = :id_lang or rt.id_language = :id_lang)
									   and r.id_article = :id_article
									   group by r.id, r.message, r.id_article, r.id_language') ;
		
		$requete->bindValue('id_lang', $id_lang, \PDO::PARAM_INT);
		$requete->bindValue('id_article', $id_article, \PDO::PARAM_INT);
		
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Resume');
		
		$resume = $requete->fetch();
		$requete->closeCursor();
		
		if($resume)
		{
			if($id_lang == $resume->id_language())
			{
				return $resume->message() ;
			}
			else 
			{
				$requete = $this->dao->query("Select message from resumetraduction where id_resume = ".$resume->id()." and id_language = $id_lang");
				return $requete->fetchColumn() ;
			}
		}
		else 
		{
			return '' ;
		}
	}
}
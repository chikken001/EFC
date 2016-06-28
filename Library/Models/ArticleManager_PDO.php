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
		$requete = $this->dao->prepare('SELECT a.* FROM article a
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
		$query = "SELECT COUNT(a.id) FROM article a
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
		$query = "SELECT a.* FROM article a
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
						//die(var_dump($query)) ;
	
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
}
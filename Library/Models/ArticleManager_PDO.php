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
}
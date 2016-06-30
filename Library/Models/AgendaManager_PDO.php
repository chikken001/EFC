<?php
namespace Library\Models;

use \Library\Entities\Agenda;
use \Library\Models\Defaut\Pdo;
use \Library\Crypt ;

class AgendaManager_PDO extends AgendaManager
{
	public function __construct($dao)
	{
		parent::__construct($dao);
		$this->DEF = new Pdo($this) ;
	}
	
	public function getByLanguage($id_lang, $offset = -1, $limit = -1)
	{
		$query = 'SELECT a.* FROM agenda a
				   left join agendatraduction at on a.id = at.id_agenda
				   where a.id_language = :id_lang or at.id_language = :id_lang
				   group by a.id, a.date, a.title, a.message, a.created_at, a.id_language
				   order by a.date';
		
		$bind[':id_lang'] = $id_lang ;
		
		if($offset >= 0 && $limit > 0)
		{
			$query .= 'limit :limit offset :offset' ;
			$bind[':limit'] = $limit ;
			$bind[':offset'] = $offset ;
		}
		
		$requete = $this->dao->prepare($query) ;
	
		foreach ($bind as $nom => $valeur)
		{
			$requete->bindValue($nom, $valeur, \PDO::PARAM_INT);
		}
	
		$requete->execute();
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Agenda');
	
		$listeAgenda = $requete->fetchAll();
	
		$requete->closeCursor();
	
		return $listeAgenda ;
	}
}
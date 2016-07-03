<?php
namespace Applications\Frontend\Modules\Equipe;

class EquipeController extends \Library\BackController
{
	public function executeIndex(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', "L'équipe");
        
        $id_lang = $this->getIdLanguage() ;
        
        $members = $this->em('Team')->DEF->getlist() ;
        $team = array() ;
        $categories = array() ;
        $jobs = array() ;
        $members_jobs = array() ;
        
        foreach($members as $member)
        {
        	$id_category = $member->id_category() ;
        	$id_member = $member->id() ;
			$category = $this->em('Category')->DEF->getUnique($id_category) ;
			$ordre = $category->ordre() ;
        	
        	if(!isset($categories[$ordre]))
        	{
        		$id_language = $category->id_language() ;
        		
        		$categories[$ordre][$id_language] = $category->name() ;
        		
        		if($id_language != $id_lang)
        		{
	        		$category_traduction = $this->em('CategoryTraduction')->DEF->getUnique(array('id_category' => $id_category, 'id_language' => $id_lang)) ;
	        		
	        		if($category_traduction)
	        		{
	        			$categories[$ordre][$id_lang] = $category_traduction->name() ;
	        		}
        		}
        	}
        	
        	if(!isset($team[$ordre]))
        	{
        		isset($categories[$ordre][$id_lang]) ? $team[$ordre]['name'] = $categories[$ordre][$id_lang] : $team[$ordre]['name'] = '' ;
        	}
        	
        	$Jobs = $this->em('Team')->DEF->getAssociate($id_member, 'job') ;
        	
        	foreach($Jobs as $associate)
        	{
        		$id_job = $associate['job'] ;
        		
        		if(!isset($jobs[$id_job]))
        		{
        			$job = $this->em('Job')->DEF->getUnique($id_job) ;
        			$id_language = $job->id_language() ;
        			
        			$jobs[$id_job][$job->id_language()] = $job->name() ;
        			
        			if($id_language != $id_lang)
        			{
	        			$job_traduction = $this->em('JobTraduction')->DEF->getUnique(array('id_job' => $id_job, 'id_language' => $id_lang)) ;

	        			if($job_traduction)
	        			{
	        				$jobs[$id_job][$id_lang] = $job_traduction->name() ;
	        			}
        			}
        		}
        		
        		isset($jobs[$id_job][$id_lang]) ? $job_name = $jobs[$id_job][$id_lang] : $job_name = '' ;
        		
        		$members_jobs[$id_member][] = $job_name ;
        	}
        	
        	if($id_lang == 1)
        	{
        		$nom = $member->last_name_ch() ;
        		$prenom = $member->first_name_ch() ;
        	}
        	else 
        	{
        		$nom = $member->last_name() ;
        		$prenom = $member->first_name() ;
        	}
        	
        	$team[$ordre]['members'][$id_member]['nom'] = $nom ;
        	$team[$ordre]['members'][$id_member]['prenom'] = $prenom ;
        	$team[$ordre]['members'][$id_member]['picture'] = $this->getPicturePath($member) ; ;
        	$team[$ordre]['members'][$id_member]['jobs'] = $members_jobs[$id_member] ;
        }
		
		ksort($team);
		
        $this->page->addVar('team', $team);
	}
	
	protected function getIdLanguage()
	{
		$lang = $this->user->getLanguage() ;
		$language = $this->em('Language')->DEF->getUnique(array('code' => $lang)) ;
		$language ? $id_lang = $language->id() : $id_lang = 3 ;
	
		return $id_lang ;
	}
	
	protected function getPicturePath($member)
	{
		$member->picture() ;
	
		$path = $_SERVER["DOCUMENT_ROOT"].PICTURE_FOLDER_TEAM ;
	
		return (!empty($picture) && file_exists($path.$picture)) ? PICTURE_FOLDER_TEAM.$picture : PICTURE_FOLDER_TEAM.'default.png' ;
	}
}
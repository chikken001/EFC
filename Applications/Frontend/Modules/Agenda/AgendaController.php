<?php
namespace Applications\Frontend\Modules\Agenda;

class AgendaController extends \Library\BackController
{
	public function executeShow(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', 'Agenda');
        
        $id_agenda = $request->getData('id_agenda') ;
        $Agenda = $this->em('Agenda')->DEF->getUnique($id_agenda) ;
        
        if($Agenda)
        {
        	$agenda = array() ;
        	$empty = '' ;
        	 
        	$id_lang = $this->getIdLanguage() ;
        	$id_language = $Agenda->id_language() ;
        	 
        	if($id_lang == $id_language)
        	{
        		$agenda['title'] = $Agenda->title() ;
        		$agenda['message'] = $Agenda->message() ;
        	}
        	else
        	{
        		$traduction = $this->em('AgendaTraduction')->DEF->getUnique(array('id_agenda' => $id_agenda, 'id_language' => $id_lang)) ;
        
        		if($traduction)
        		{
        			$agenda['title'] = $traduction->title() ;
        			$agenda['message'] = $traduction->message() ;
        		}
        		else
        		{
        			$no_traduction = array(1 => '有一个在你的语言中没有翻译这个事件', 2 => "Il n'y a aucune traduction dans votre langue pour cet évenement", 3 => 'There is no translation in your language for this event');
        			isset($no_traduction[$id_lang]) ? $empty = $no_traduction[$id_lang] : $empty = $no_traduction[3] ;
        		}
        	}
        	 
        	if(!empty($agenda))
        	{
        		$agenda['created_at'] = $Agenda->created_at() ;
        		$agenda['date'] = $Agenda->date() ;
        	}
        	 
        	$this->page->addVar('agenda', $agenda);
        	$this->page->addVar('empty', $empty);
        }
        else
        {
        	$this->app->httpResponse()->redirectError('404');
        }
	}
    
    public function executeList(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', 'Agenda');
        
        $id_lang = $this->getIdLanguage() ;
        
        $Agendas = $this->em('Agenda')->getByLanguage($id_lang) ;
        $agendas = array() ;
        
        foreach($Agendas as $agenda)
        {
        	$id_language = $agenda->id_language() ;
        	$id_agenda = $agenda->id() ;
        
        	$agendas[$id_agenda]['created_at'] = $agenda->created_at() ;
        	$agendas[$id_agenda]['date'] = $agenda->date() ;
        
        	if($id_lang == $id_language)
        	{
        		$agendas[$id_agenda]['title'] = $agenda->title() ;
        		$agendas[$id_agenda]['message'] = $agenda->message() ;
        		$agendas[$id_agenda]['place'] = $agenda->place() ;
        		$agendas[$id_agenda]['city'] = $agenda->city() ;
        	}
        	else
        	{
        		$traduction = $this->em('AgendaTraduction')->DEF->getUnique(array('id_agenda' => $id_agenda, 'id_language' => $id_lang)) ;
        		$agendas[$id_agenda]['title'] = $traduction->title() ;
        		$agendas[$id_agenda]['message'] = $traduction->message();
        		$agendas[$id_agenda]['place'] = $traduction->place() ;
        		$agendas[$id_agenda]['city'] = $traduction->city() ;
        	}
			
			$agendas[$id_agenda]['postal_code'] = $agenda->postal_code() ;
			$agendas[$id_agenda]['address'] = $agenda->address() ;
			
			$type = $this->em('Type')->DEF->getUnique($agenda->id_type()) ;
			
			if($type->id_language() != $id_lang)
			{
				$typetraduction = $this->em('TypeTraduction')->DEF->getUnique(array('id_type' => $agenda->id_type(), 'id_language' => $id_lang)) ;
				$typetraduction ? $event = $typetraduction->name() : $event = $type->name() ;
			}
			else
			{
				$event = $type->name() ;
			}
			
			$agendas[$id_agenda]['event'] = $event ;
        }
        
        $this->page->addVar('agendas', $agendas);
	}
	
	protected function getIdLanguage()
	{
		$lang = $this->user->getLanguage() ;
		$language = $this->em('Language')->DEF->getUnique(array('code' => $lang)) ;
		$language ? $id_lang = $language->id() : $id_lang = 3 ;
	
		return $id_lang ;
	}
}
<?php
namespace Applications\Frontend\Modules\Agenda;

class AgendaController extends \Library\BackController
{
	public function executeShow(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', 'Agenda');
	}
    
    public function executeList(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', 'Agenda');
	}
}
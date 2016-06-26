<?php
namespace Applications\Frontend\Modules\Equipe;

class EquipeController extends \Library\BackController
{
	public function executeIndex(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', "L'équipe");
	}
}
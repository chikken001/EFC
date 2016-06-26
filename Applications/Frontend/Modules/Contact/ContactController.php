<?php
namespace Applications\Frontend\Modules\Contact;

class ContactController extends \Library\BackController
{
	public function executeIndex(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', "Contact");
	}
}
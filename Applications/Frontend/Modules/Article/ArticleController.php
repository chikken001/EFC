<?php
namespace Applications\Frontend\Modules\Article;

class ArticleController extends \Library\BackController
{
	public function executeShow(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', 'Article');
	}
    
    public function executeList(\Library\HTTPRequest $request)
	{
        $this->page->addVar('title', 'Articles');
	}
}
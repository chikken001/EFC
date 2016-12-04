<?php

namespace Efc\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EfcCmsBundle:Default:index.html.twig');
    }
}

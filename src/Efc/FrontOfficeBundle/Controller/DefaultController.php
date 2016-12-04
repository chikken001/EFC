<?php

namespace Efc\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EfcFrontOfficeBundle:Default:index.html.twig');
    }
}

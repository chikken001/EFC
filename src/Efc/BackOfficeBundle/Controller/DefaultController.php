<?php

namespace Efc\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EfcBackOfficeBundle:Default:index.html.twig');
    }
}

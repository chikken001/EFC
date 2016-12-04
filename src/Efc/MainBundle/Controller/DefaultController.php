<?php

namespace Efc\MainBundle\Controller;

use Efc\MainBundle\Entity\Centre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $centre = new Centre() ;

        return $this->render('EfcMainBundle:Default:index.html.twig');
    }
}

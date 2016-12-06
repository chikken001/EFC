<?php

namespace Efc\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EquipeController extends Controller
{
    public function indexAction()
    {
        return $this->render('EfcCmsBundle:Equipe:index.html.twig');
    }
}

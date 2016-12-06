<?php

namespace Efc\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function listeAction()
    {
        return $this->render('EfcCmsBundle:Article:liste.html.twig');
    }

    public function showAction()
    {
        return $this->render('EfcCmsBundle:Article:show.html.twig');
    }
}
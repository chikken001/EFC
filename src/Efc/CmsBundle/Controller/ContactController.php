<?php

namespace Efc\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function indexAction()
    {
        return $this->render('EfcCmsBundle:Contact:index.html.twig');
    }
}

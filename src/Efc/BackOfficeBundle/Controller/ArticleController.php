<?php

namespace Efc\BackOfficeBundle\Controller;

use Efc\MainBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

class ArticleController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('EfcMainBundle:Article')->findAll();

        return $this->render('EfcBackOfficeBundle:Article:index.html.twig', array(
            'articles' => $articles
        ));
    }

    /**
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Article $article)
    {
        // send view
        return $this->render('EfcBackOfficeBundle:Article:view.html.twig', array(
            'article' => $article
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser() ;

        $article = new Article();

        // send view
        return $this->render('EfcBackOfficeBundle:Article:create.html.twig', array(

        ));
    }

    /**
     * @param Article $article
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Article $article, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('EfcBackOfficeBundle:Article:edit.html.twig', array(
        ));
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Request $request, Article $article)
    {
        // send view
        return $this->render('EfcBackOfficeBundle:Article:delete.html.twig', array(
            'article' => $article
        ));
    }
}

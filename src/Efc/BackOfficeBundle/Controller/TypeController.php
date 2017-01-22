<?php

namespace Efc\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Efc\MainBundle\Entity\Type;
use Symfony\Component\HttpFoundation\JsonResponse;

class TypeController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('EfcMainBundle:Type')->findAll();

        return $this->render('@EfcBackOffice/Type/liste.html.twig', array(
            'types' => $types
        ));
    }

    /**
     * @return string
     */
    public function addTypeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $nom = $request->request->get('type')['nom'];

        $exist = $em->getRepository('EfcMainBundle:Type')->findOneByNom($nom);

        $response = new JsonResponse();

        if(!$exist)
        {
            $type = new Type();

            $type->setNom($nom);

            $em->persist($type);
            $em->flush();

            $id = $type->getId() ;

            $response->setData(array(
                'message' => 'ok',
                'id' => $id,
                'nom' => $nom
            ));
        }
        else
        {
            $response->setData(array(
                'message' => "Ce type d'article existe déjà"
            ));
        }

        return $response;
    }

    /**
     * @return string
     */
    public function removeTypeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $msg = 'ok' ;

        $id_type = (int) $request->request->get('id');
        $type = $em->getRepository('EfcMainBundle:Type')->find($id_type);

        if($type && $type->getArticles()->isEmpty())
        {
            $em->remove($type);
            $em->flush();
        }
        else
        {
            $msg ="Ce type d'article est encore utilisé par un ou plusieurs articles ou est invalide" ;
        }

        $response = new JsonResponse();
        $response->setData(array(
            'message' => $msg,
            'id' => $id_type
        ));

        return $response;
    }
}

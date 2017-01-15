<?php

namespace Efc\BackOfficeBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseSecurityController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SecurityController extends BaseSecurityController
{
    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderLogin(array $data)
    {
        if($this->container->get('security.context')->isGranted(array('ROLE_ADMIN', 'ROLE_SUPER_ADMIN')))
        {
            return new RedirectResponse($this->container->get('Router')->generate('efc_back_office_homepage'));
        }

        return $this->container->get('templating')->renderResponse('EfcBackOfficeBundle:Security:login.html.twig', $data);
    }
}
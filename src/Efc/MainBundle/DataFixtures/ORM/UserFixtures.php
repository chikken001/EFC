<?php

namespace Efc\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Efc\MainBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class UserFixtures extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $admin = new User();
        $admin->setRoles(array(User::ROLE_SUPER_ADMIN));
        $admin->setUsername('admin');
        $admin->setUsernameCanonical('admin');
        $admin->setEmail('contact@environnement-france-chine.org');
        $admin->setEmailCanonical('contact@environnement-france-chine.org');
        $admin->setPlainPassword('qqq');
        $admin->setEnabled(1);
        $admin->setGender('M');

        $userManager->updateUser($admin, true);
        $this->addReference('admin', $admin);
    }
}
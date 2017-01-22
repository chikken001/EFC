<?php

namespace Efc\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Efc\MainBundle\Entity\Type;

class TypeFixtures extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function getOrder()
    {
        return 2;
    }

    public function load(ObjectManager $manager)
    {
        $type = new Type();
        $type->setNom('CONFERENCE');
        $manager->persist($type);

        $type = new Type();
        $type->setNom('VOYAGE');
        $manager->persist($type);

        $type = new Type();
        $type->setNom('RENCONTRE');
        $manager->persist($type);

        $type = new Type();
        $type->setNom('ATELIER');
        $manager->persist($type);

        $type = new Type();
        $type->setNom('ANUELLE');
        $manager->persist($type);

        $type = new Type();
        $type->setNom('DOSSIER');
        $manager->persist($type);

        $type = new Type();
        $type->setNom('CONGRES');
        $manager->persist($type);

        $manager->flush();
    }
}
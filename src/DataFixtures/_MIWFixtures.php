<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

use App\Entity\AdminUser;

class _MIWFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $miw = new AdminUser();
        $miw->setLogin("MIW");
        $miw->setPassword("MIW");
        $miw->setEmail("");
        $this->addReference("miw", $miw);

        $manager->persist($miw);
        $manager->flush();
    }
}
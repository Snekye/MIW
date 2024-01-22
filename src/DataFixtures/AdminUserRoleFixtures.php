<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\AdminUserRole;
use App\Entity\AdminLog;

class AdminUserRoleFixtures extends Fixture implements DependentFixtureInterface
{
    public const ADMIN_USER_ROLES = [

        // Niveau : 1 -> éditeur ; 2 -> admin ; 3 -> superadmin
        // éditeur : ajout/suppression/modif de contenus
        // admin : ^ + accès au logs + accès config
        // superadmin : ^ + ajout/suppression/modif d'admins

       "ROLE_SUPERADMIN" => [
            "lib" => "Superadmin",
            "niveau" => 3,
       ],
       "ROLE_ADMIN" => [
            "lib" => "Admin",
            "niveau" => 2,
        ],
        "ROLE_EDITEUR" => [
            "lib" => "Éditeur",
            "niveau" => 1,
        ],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach($this::ADMIN_USER_ROLES as $k => $e) {
            $temp = new AdminUserRole();
            $temp->setLib($e["lib"]);
            $temp->setCode($k);
            $temp->setNiveau($e["niveau"]);

            $log = new AdminLog();
            $log->setUserLogin($this->getReference("miw"));
            $log->setAction("Create");
            $log->setMessage("[MIW] à créé le rôle utilisateur [".$e["lib"]."]");

            $temp->setCreated($log);

            $this->addReference($k,$temp);

            $manager->persist($temp);
        }

        $manager->flush();
    }

    public function getDependencies() {
        return array(
            _MIWFixtures::class
        );
    }
}

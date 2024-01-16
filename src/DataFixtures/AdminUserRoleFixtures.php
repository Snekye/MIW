<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\AdminUserRole;

class AdminUserRoleFixtures extends Fixture
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
            $temp->setNiveau($e["niveau"]);

            $this->addReference($k,$temp);

            $manager->persist($temp);
        }

        $manager->flush();
    }
}

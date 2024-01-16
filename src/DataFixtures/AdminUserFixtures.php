<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

use App\Entity\AdminUser;

class AdminUserFixtures extends Fixture
{
    private $hasher;

    public function __construct(PasswordHasherFactoryInterface $factory) 
    {
        $this->hasher = $factory->getPasswordHasher('soft');
    }
    public const ADMIN_USER = [

        // Niveau : 1 -> éditeur ; 2 -> admin ; 3 -> superadmin
        // éditeur : ajout/suppression/modif de contenus
        // admin : ^ + accès au logs + accès config
        // superadmin : ^ + ajout/suppression/modif d'admins

        ["login" => "Dimitri",
            "password" => "Dimitri",
            "email" => "dimitrigranit22@gmail.com",
            "niveau" => 3],
        ["login" => "Rodolphe",
            "password" => "Rodolphe",
            "email" => "rodolphe@maxinfoweb.com",
            "niveau" => 2],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach($this::ADMIN_USER as $e) {
            $temp = new AdminUser();
            $temp->setLogin($e["login"]);

            $hashedPassword = $this->hasher->hash($e["password"]);

            $temp->setPassword($hashedPassword);
            $temp->setEmail($e["email"]);
            $temp->setNiveau($e["niveau"]);

            $manager->persist($temp);
        }

        $manager->flush();
    }
}

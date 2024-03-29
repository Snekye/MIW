<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

use App\Entity\AdminUser;
use App\Entity\AdminLog;

class AdminUserFixtures extends Fixture implements DependentFixtureInterface
{
    private $hasher;

    public function __construct(PasswordHasherFactoryInterface $factory) 
    {
        $this->hasher = $factory->getPasswordHasher('soft');
    }
    public const ADMIN_USER = [

        ["login" => "Dimitri",
            "password" => "Dimitri",
            "email" => "dimitrigranit22@gmail.com",
            "role" => "ROLE_SUPERADMIN"],

        ["login" => "Rodolphe",
            "password" => "Rodolphe",
            "email" => "rodolphe@maxinfoweb.com",
            "role" => "ROLE_ADMIN"],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach($this::ADMIN_USER as $e) {

            $temp = new AdminUser();
            $temp->setLogin($e["login"]);
            $temp->setEmail($e["email"]);
            $hashedPassword = $this->hasher->hash($e["password"]);
            $temp->setPassword($hashedPassword);

            $temp->setRole($this->getReference($e["role"]));

            $log = new AdminLog();
            $log->setUserLogin($this->getReference("miw"));
            $log->setAction("Create");
            $log->setMessage("[MIW] à créé l'utilisateur [".$e["login"]."]");

            $temp->setCreated($log);

            $manager->persist($temp);
        }

        $manager->flush();
    }

    public function getDependencies() {
        return array(
            AdminUserRoleFixtures::class,
            _MIWFixtures::class
        );
    }
}

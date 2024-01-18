<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\Contact;

class ContactFixtures extends Fixture
{
    public const CONTACTS = [
        ["nom" => "Granit",
            "prenom" => "Dimitri",
            "entreprise" => "MIW",
            "ville" => "Neuilly-en-Thelle",
            "email" => "dimitrigranit22@gmail.com",
            "tel" => "01 02 03 04 05",
            "contenu" => "test"]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach ($this::CONTACTS as $e)
        {
            $temp = new Contact();

            $temp->setNom($e["nom"]);
            $temp->setPrenom($e["prenom"]);
            $temp->setEntreprise($e["entreprise"]);
            $temp->setVille($e["ville"]);
            $temp->setEmail($e["email"]);
            $temp->setTel($e["tel"]);
            $temp->setContenu($e["contenu"]);
            $temp->setDate(new \DateTime('now'));

            $manager->persist($temp);

            $manager->flush();
        }
    }
}

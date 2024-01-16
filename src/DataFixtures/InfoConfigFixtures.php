<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\InfoConfig;

class InfoConfigFixtures extends Fixture
{
    public const INFO_CONFIG = [

        "agence_adresse" => 
            "15, Place du Maréchal Leclerc\n
            60530 NEUILLY EN THELLE",
        "agence_tel" => "09.72.30.50.60",
        "siege_adresse" => 
            "30 bis Rue du Colombier\n
            60660 Cires-les-mello",
        "siege_tel" => "03.44.73.56.82",
        "horaires" => "du lundi au vendredi, de 10h à 18h",
        "site_titre" => "Maxinfoweb - Création de site Internet Oise et Informatique",
        "site_metadescription" => "MIW Informatique : maintenance informatique et dépannage pour les entreprises, dans l'Oise, Ile de France et Paris.",
        "site_visibilite" => "public" // public / admin / off
    ];
    public function load(ObjectManager $manager): void
    {
        foreach ($this::INFO_CONFIG as $k => $e)
        {
            $temp = new InfoConfig();

            $temp->setLib($k);
            $temp->setValeur($e);

            $manager->persist($temp);

            $manager->flush();
        }
    }
}

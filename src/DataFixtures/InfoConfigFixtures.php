<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\InfoConfig;
use App\Entity\AdminLog;

class InfoConfigFixtures extends Fixture implements DependentFixtureInterface
{
    public const INFO_CONFIG = [

        "agence_adresse_1" => "15, Place du Maréchal Leclerc",
        "agence_adresse_2" => "60530 NEUILLY EN THELLE",
        "agence_tel" => "09.72.30.50.60",
        "siege_adresse_1" => "30 bis Rue du Colombier",
        "siege_adresse_2" => "60660 Cires-les-mello",
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

            $log = new AdminLog();
            $log->setUserLogin($this->getReference("miw"));
            $log->setAction("Create");
            $log->setMessage("[MIW] à créé la configuration [".$k."]");

            $temp->setCreated($log);

            $manager->persist($temp);

            $manager->flush();
        }
    }

    public function getDependencies() {
        return array(
            _MIWFixtures::class
        );
    }
}

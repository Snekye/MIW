<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\Image;

class ImageFixtures extends Fixture
{
    public const IMAGES = [
        "test.png"
    ];
    public function load(ObjectManager $manager): void
    {
        foreach ($this::IMAGES as $e)
        {
            $temp = new Image();

            $temp->setLien($e);

            $manager->persist($temp);

            $manager->flush();
        }
    }
}

<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

use App\Entity\AdminUser;

class _UploadFolderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        array_map('unlink', glob("public/img/upload/News/*"));
        array_map('unlink', glob("public/img/upload/BlogArticle/*"));
        array_map('unlink', glob("public/img/upload/Competence/*"));
        array_map('unlink', glob("public/img/upload/PresentationPartenaire/*"));
        array_map('unlink', glob("public/img/upload/Reseau/*"));

        //rmdir
    }
}

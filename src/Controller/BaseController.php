<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\InfoConfig;
use App\Entity\Reseau;

class BaseController extends AbstractController
{
    public static function getBase(EntityManagerInterface $m): array
    {
        return [
          'infos' => $m->getRepository(InfoConfig::class)->findAll(),
          'reseaux' => $m->getRepository(Reseau::class)->findAll(),
        ];
    }
}
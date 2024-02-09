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
          'info' => 
          array_reduce(
              array_map(
                  function ($x) {return [$x->getLib() => $x->getValeur()];}
                  ,$m->getRepository(InfoConfig::class)->findAll()),
              'array_merge',[]),
              
          'reseaux' => $m->getRepository(Reseau::class)->findAll(),
        ];
    }
}
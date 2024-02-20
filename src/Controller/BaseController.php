<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\InfoConfig;
use App\Entity\Reseau;

class BaseController extends AbstractController
{
    public static function getBase(EntityManagerInterface $m): array
    {
        // mapping de [InfoConfig{lib,valeur},...] => ["lib => "valeur",...].
        $info = 
        array_reduce(
            array_map(
                function ($x) {return [$x->getLib() => $x->getValeur()];}
                ,$m->getRepository(InfoConfig::class)->findAll()),
            'array_merge',[]);

        if (!in_array($info["site_visibilite"],["public","debug"]))
        {
            throw new HttpException(503, "Service indisponible ou en maintenance.");
        }

        return [
          'info' => $info, 
          'reseaux' => $m->getRepository(Reseau::class)->findAll(),
        ];
    }
}
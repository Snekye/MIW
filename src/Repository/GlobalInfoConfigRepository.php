<?php

namespace App\Repository;

use App\Entity\InfoConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InfoConfig>
 *
 * @method InfoConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoConfig[]    findAll()
 * @method InfoConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlobalInfoConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoConfig::class);
    }

//    /**
//     * @return InfoConfig[] Returns an array of InfoConfig objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InfoConfig
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\DepannageTarif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DepannageTarif>
 *
 * @method DepannageTarif|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepannageTarif|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepannageTarif[]    findAll()
 * @method DepannageTarif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepannageTarifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepannageTarif::class);
    }

//    /**
//     * @return DepannageTarif[] Returns an array of DepannageTarif objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DepannageTarif
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

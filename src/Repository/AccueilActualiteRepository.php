<?php

namespace App\Repository;

use App\Entity\AccueilActualite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccueilActualite>
 *
 * @method AccueilActualite|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccueilActualite|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccueilActualite[]    findAll()
 * @method AccueilActualite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccueilActualiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccueilActualite::class);
    }

//    /**
//     * @return AccueilActualite[] Returns an array of AccueilActualite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AccueilActualite
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

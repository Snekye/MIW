<?php

namespace App\Repository;

use App\Entity\Adminuserdroit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Adminuserdroit>
 *
 * @method Adminuserdroit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adminuserdroit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adminuserdroit[]    findAll()
 * @method Adminuserdroit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminuserdroitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adminuserdroit::class);
    }

//    /**
//     * @return Adminuserdroit[] Returns an array of Adminuserdroit objects
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

//    public function findOneBySomeField($value): ?Adminuserdroit
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

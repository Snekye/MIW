<?php

namespace App\Repository;

use App\Entity\AdminAccessLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AdminAccessLog>
 *
 * @method AdminAccessLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdminAccessLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdminAccessLog[]    findAll()
 * @method AdminAccessLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminAccessLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdminAccessLog::class);
    }

//    /**
//     * @return AdminAccessLog[] Returns an array of AdminAccessLog objects
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

//    public function findOneBySomeField($value): ?AdminAccessLog
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

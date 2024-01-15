<?php

namespace App\Repository;

use App\Entity\PresentationDepannageTarif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PresentationDepannageTarif>
 *
 * @method PresentationDepannageTarif|null find($id, $lockMode = null, $lockVersion = null)
 * @method PresentationDepannageTarif|null findOneBy(array $criteria, array $orderBy = null)
 * @method PresentationDepannageTarif[]    findAll()
 * @method PresentationDepannageTarif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresentationDepannageTarifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PresentationDepannageTarif::class);
    }

//    /**
//     * @return PresentationDepannageTarif[] Returns an array of PresentationDepannageTarif objects
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

//    public function findOneBySomeField($value): ?PresentationDepannageTarif
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

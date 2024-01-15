<?php

namespace App\Repository;

use App\Entity\PresentationDepannageTarifDeplacement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PresentationDepannageTarifDeplacement>
 *
 * @method PresentationDepannageTarifDeplacement|null find($id, $lockMode = null, $lockVersion = null)
 * @method PresentationDepannageTarifDeplacement|null findOneBy(array $criteria, array $orderBy = null)
 * @method PresentationDepannageTarifDeplacement[]    findAll()
 * @method PresentationDepannageTarifDeplacement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresentationDepannageTarifDeplacementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PresentationDepannageTarifDeplacement::class);
    }

//    /**
//     * @return PresentationDepannageTarifDeplacement[] Returns an array of PresentationDepannageTarifDeplacement objects
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

//    public function findOneBySomeField($value): ?PresentationDepannageTarifDeplacement
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

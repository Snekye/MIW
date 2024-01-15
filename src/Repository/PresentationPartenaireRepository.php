<?php

namespace App\Repository;

use App\Entity\PresentationPartenaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PresentationPartenaire>
 *
 * @method PresentationPartenaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method PresentationPartenaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method PresentationPartenaire[]    findAll()
 * @method PresentationPartenaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresentationPartenaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PresentationPartenaire::class);
    }

//    /**
//     * @return PresentationPartenaire[] Returns an array of PresentationPartenaire objects
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

//    public function findOneBySomeField($value): ?PresentationPartenaire
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

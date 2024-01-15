<?php

namespace App\Repository;

use App\Entity\PresentationRecrutementPoste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PresentationRecrutementPoste>
 *
 * @method PresentationRecrutementPoste|null find($id, $lockMode = null, $lockVersion = null)
 * @method PresentationRecrutementPoste|null findOneBy(array $criteria, array $orderBy = null)
 * @method PresentationRecrutementPoste[]    findAll()
 * @method PresentationRecrutementPoste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresentationRecrutementPosteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PresentationRecrutementPoste::class);
    }

//    /**
//     * @return PresentationRecrutementPoste[] Returns an array of PresentationRecrutementPoste objects
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

//    public function findOneBySomeField($value): ?PresentationRecrutementPoste
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

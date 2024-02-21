<?php

namespace App\Repository;

use App\Entity\RecrutementPoste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecrutementPoste>
 *
 * @method RecrutementPoste|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecrutementPoste|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecrutementPoste[]    findAll()
 * @method RecrutementPoste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecrutementPosteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecrutementPoste::class);
    }

//    /**
//     * @return RecrutementPoste[] Returns an array of RecrutementPoste objects
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

//    public function findOneBySomeField($value): ?RecrutementPoste
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

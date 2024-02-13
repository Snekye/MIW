<?php

namespace App\Repository;

use App\Entity\ProjetImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProjetImage>
 *
 * @method ProjetImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetImage[]    findAll()
 * @method ProjetImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjetImage::class);
    }

//    /**
//     * @return ProjetImage[] Returns an array of ProjetImage objects
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

//    public function findOneBySomeField($value): ?ProjetImage
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

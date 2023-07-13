<?php

namespace App\Repository;

use App\Entity\Yes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Yes>
 *
 * @method Yes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Yes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Yes[]    findAll()
 * @method Yes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Yes::class);
    }

//    /**
//     * @return Yes[] Returns an array of Yes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('y')
//            ->andWhere('y.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('y.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Yes
//    {
//        return $this->createQueryBuilder('y')
//            ->andWhere('y.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

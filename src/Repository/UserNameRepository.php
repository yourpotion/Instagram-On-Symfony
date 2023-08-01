<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserName>
 *
 * @method UserName|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserName|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserName[]    findAll()
 * @method UserName[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserNameRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserName::class);
    }

    //    /**
    //     * @return UserName[] Returns an array of UserName objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UserName
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

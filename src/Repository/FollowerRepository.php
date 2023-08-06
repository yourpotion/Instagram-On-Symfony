<?php

namespace App\Repository;

use App\Entity\Follower;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Follower>
 *
 * @method Follower|null find($id, $lockMode = null, $lockVersion = null)
 * @method Follower|null findOneBy(array $criteria, array $orderBy = null)
 * @method Follower[]    findAll()
 * @method Follower[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FollowerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Follower::class);
    }

            /**
     * @param Follower $follower
     * 
     * @return void
     */
    public function save(Follower $follower): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($follower);
        $entityManager->flush();
    }


    /**
     * @param Following $following
     * 
     * @return void
     */
    public function remove(Follower $follower): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($follower);
        $entityManager->flush();
    }

//    /**
//     * @return Follower[] Returns an array of Follower objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Follower
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

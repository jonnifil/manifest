<?php

namespace App\Repository;

use App\Entity\Singleton;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Singleton|null find($id, $lockMode = null, $lockVersion = null)
 * @method Singleton|null findOneBy(array $criteria, array $orderBy = null)
 * @method Singleton[]    findAll()
 * @method Singleton[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SingletonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Singleton::class);
    }

    // /**
    //  * @return Singleton[] Returns an array of Singleton objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Singleton
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

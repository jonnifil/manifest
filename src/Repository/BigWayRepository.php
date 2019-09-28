<?php

namespace App\Repository;

use App\Entity\Bigway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BigWay|null find($id, $lockMode = null, $lockVersion = null)
 * @method BigWay|null findOneBy(array $criteria, array $orderBy = null)
 * @method BigWay[]    findAll()
 * @method BigWay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BigWayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bigway::class);
    }

    // /**
    //  * @return Bigway[] Returns an array of Bigway objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bigway
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

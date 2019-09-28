<?php

namespace App\Repository;

use App\Entity\Aff;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Aff|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aff|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aff[]    findAll()
 * @method Aff[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aff::class);
    }

    // /**
    //  * @return Aff[] Returns an array of Aff objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aff
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

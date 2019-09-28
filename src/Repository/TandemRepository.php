<?php

namespace App\Repository;

use App\Entity\Tandem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tandem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tandem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tandem[]    findAll()
 * @method Tandem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TandemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tandem::class);
    }

    // /**
    //  * @return Tandem[] Returns an array of Tandem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tandem
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\Role;
use App\Entity\WorkDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method WorkDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkDay[]    findAll()
 * @method WorkDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkDayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkDay::class);
    }

    // /**
    //  * @return WorkDay[] Returns an array of WorkDay objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkDay
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findCurrent( Company $company): ?WorkDay
    {
        $currentDate = (new \DateTime())->format('Y-m-d');
        return $this->createQueryBuilder('w')
            ->andWhere('w.company = :val')
            ->setParameter('val', $company)
            ->andWhere("w.day LIKE :day")
            ->setParameter('day', $currentDate . '%')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}

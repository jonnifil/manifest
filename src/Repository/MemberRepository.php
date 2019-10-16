<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\Member;
use App\Entity\Role;
use App\Entity\WorkDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Member|null find($id, $lockMode = null, $lockVersion = null)
 * @method Member|null findOneBy(array $criteria, array $orderBy = null)
 * @method Member[]    findAll()
 * @method Member[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Member::class);
    }

    /**
     * @param Company $company
     * @param WorkDay|null $workDay
     * @param array $roles
     * @return array|mixed
     */
    public function findByRoles(Company $company, WorkDay $workDay=null, $roles=[Role::SINGLETON])
    {
        $query = $this->createQueryBuilder('m')
            ->join('m.roles', 'mr')
            ->andWhere('m.company=:company')
            ->setParameter('company', $company)
            ->andWhere('mr.id IN (:val)')
            ->setParameter('val', $roles)
            ;
        if (isset($workDay) && $workDay instanceof WorkDay) {
            $memberIds = $workDay->getMemberIds();
            if (!$memberIds)
                return [];
            $query
                ->andWhere('m.id IN (:ids)')
                ->setParameter('ids', $memberIds)
            ;
        }

        return $query
            ->groupBy('m.id')
            ->orderBy('m.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Member[] Returns an array of Member objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Member
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

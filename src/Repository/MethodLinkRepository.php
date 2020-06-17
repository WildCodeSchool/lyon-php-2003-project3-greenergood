<?php

namespace App\Repository;

use App\Entity\MethodLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MethodLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method MethodLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method MethodLink[]    findAll()
 * @method MethodLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MethodLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MethodLink::class);
    }

    // /**
    //  * @return MethodLink[] Returns an array of MethodLink objects
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
    public function findOneBySomeField($value): ?MethodLink
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

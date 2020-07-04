<?php

namespace App\Repository;

use App\Entity\ActionDeliverable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ActionDeliverable|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActionDeliverable|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActionDeliverable[]    findAll()
 * @method ActionDeliverable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActionDeliverableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActionDeliverable::class);
    }

    // /**
    //  * @return ActionDeliverable[] Returns an array of ActionDeliverable objects
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
    public function findOneBySomeField($value): ?ActionDeliverable
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

<?php

namespace App\Repository;

use App\Entity\Action;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Action|null find($id, $lockMode = null, $lockVersion = null)
 * @method Action|null findOneBy(array $criteria, array $orderBy = null)
 * @method Action[]    findAll()
 * @method Action[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Action::class);
    }

    /**
     * @return Action[] Returns an array of Action objects
     */

    public function findByFilter($filter)
    {
        switch ($filter) {
            case 'status':
                $order = 'DESC';
                break;
            case 'startdate':
                $filter = "startDate";
                $order = 'DESC';
                break;
            default:
                $order = 'ASC';
                break;
        }

        return $this->createQueryBuilder('a')
            ->orderBy("a.$filter", "$order")
            ->getQuery()
            ->getResult()
            ;
    }

    public function search($search)
    {
        $qb = $this->createQueryBuilder('a');
        return $qb
            ->where(
                $qb->expr()->like('a.name', ':search')
            )
            ->setParameter('search', '%' . $search . '%')
            ->getQuery()
            ->getResult();
    }
}

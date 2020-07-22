<?php

namespace App\Repository;

use App\Entity\Method;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Method|null find($id, $lockMode = null, $lockVersion = null)
 * @method Method|null findOneBy(array $criteria, array $orderBy = null)
 * @method Method[]    findAll()
 * @method Method[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MethodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Method::class);
    }

    public function search($search)
    {
        $qb = $this->createQueryBuilder('m');
        return $qb
            ->where(
                $qb->expr()->like('m.name', ':search')
            )
            ->setParameter('search', '%' . $search . '%')
            ->getQuery()
            ->getResult();
    }
}

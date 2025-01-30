<?php

namespace App\Repository;

use App\Entity\Inspiration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class InspirationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inspiration::class);
    }

    public function searchByTerm(string $term)
    {
        $queryBuilder = $this->createQueryBuilder('i')
            ->andWhere('LOWER(i.title) LIKE LOWER(:term) OR LOWER(i.content) LIKE LOWER(:term)')
            ->setParameter('term', '%' . $term . '%')
            ->orderBy('i.createdAt', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }
}

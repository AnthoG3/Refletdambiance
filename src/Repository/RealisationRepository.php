<?php

namespace App\Repository;

use App\Entity\Realisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RealisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Realisation::class);
    }

    public function searchByTerm(string $term)
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->andWhere('LOWER(r.title) LIKE LOWER(:term) OR LOWER(r.content) LIKE LOWER(:term)')
            ->setParameter('term', '%' . $term . '%')
            ->orderBy('r.createdAt', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }
}

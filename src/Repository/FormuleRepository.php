<?php

namespace App\Repository;

use App\Entity\Formule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

class FormuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formule::class);
    }

    public function searchByTerm(string $term)
    {
        $queryBuilder = $this->createQueryBuilder('f')
            ->andWhere('LOWER(f.title) LIKE LOWER(:term) OR LOWER(f.content) LIKE LOWER(:term)')
            ->setParameter('term', '%' . $term . '%')
            ->orderBy('f.createdAt', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }
}

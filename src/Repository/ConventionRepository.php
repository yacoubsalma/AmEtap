<?php
namespace App\Repository;

use App\Entity\Convention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ConventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Convention::class);
    }

public function searchByNom($query)
    {
    return $this->createQueryBuilder('s')
        ->andWhere('s.title LIKE :query')
        ->setParameter('query', $query.'%')
        ->orderBy('s.title', 'ASC')
        ->getQuery()
        ->getResult();
    }
}
<?php

namespace App\Repository;

use App\Entity\VinylMix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VinylMix>
 */
class VinylMixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VinylMix::class);
    }

        public function createOrderedByVotesQueryBuilder(string $genre = null): QueryBuilder
        {
            $queryBuilder = $this->addOrderByVotesQueryBuilder();

            if ($genre) {
                $queryBuilder->andWhere('v.genre = :genre')
                ->setParameter('genre', $genre);
            }

            return $queryBuilder;
        }

        private function addOrderByVotesQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
        {
            $queryBuilder = $queryBuilder ??  $this->createQueryBuilder('v');
            $queryBuilder->orderBy('v.votes', 'DESC');

            return $queryBuilder;
        }
}

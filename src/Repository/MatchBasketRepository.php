<?php

namespace App\Repository;

use App\Entity\MatchBasket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MatchBasket>
 *
 * @method MatchBasket|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchBasket|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchBasket[]    findAll()
 * @method MatchBasket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchBasketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchBasket::class);
    }

//    /**
//     * @return MatchBasket[] Returns an array of MatchBasket objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MatchBasket
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

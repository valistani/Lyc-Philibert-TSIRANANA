<?php

namespace App\Repository;

use App\Entity\Parain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Parain|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parain|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parain[]    findAll()
 * @method Parain[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParainRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parain::class);
    }

    // /**
    //  * @return Parain[] Returns an array of Parain objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Parain
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

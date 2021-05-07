<?php

namespace App\Repository;

use App\Entity\WebCreation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WebCreation|null find($id, $lockMode = null, $lockVersion = null)
 * @method WebCreation|null findOneBy(array $criteria, array $orderBy = null)
 * @method WebCreation[]    findAll()
 * @method WebCreation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebCreationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebCreation::class);
    }

    // /**
    //  * @return WebCreation[] Returns an array of WebCreation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WebCreation
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\GraphicCreation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GraphicCreation|null find($id, $lockMode = null, $lockVersion = null)
 * @method GraphicCreation|null findOneBy(array $criteria, array $orderBy = null)
 * @method GraphicCreation[]    findAll()
 * @method GraphicCreation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GraphicCreationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GraphicCreation::class);
    }

    /**
     * @return GraphicCreation[] Returns an array of GraphicCreation objects
     */
    
    public function findBySlug($value)
    {
        return $this->createQueryBuilder('graphic')
            ->andWhere('graphic.slug = :val')
            ->setParameter('val', $value)
            ->orderBy('graphic.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?GraphicCreation
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Tets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tets[]    findAll()
 * @method Tets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tets::class);
    }

    // /**
    //  * @return Tets[] Returns an array of Tets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tets
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

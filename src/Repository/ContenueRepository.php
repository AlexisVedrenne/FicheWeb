<?php

namespace App\Repository;

use App\Entity\Contenue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contenue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contenue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contenue[]    findAll()
 * @method Contenue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contenue::class);
    }

    // /**
    //  * @return Contenue[] Returns an array of Contenue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contenue
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

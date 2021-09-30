<?php

namespace App\Repository;

use App\Entity\CommentaireCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentaireCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireCategorie[]    findAll()
 * @method CommentaireCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentaireCategorie::class);
    }

    // /**
    //  * @return CommentaireCategorie[] Returns an array of CommentaireCategorie objects
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
    public function findOneBySomeField($value): ?CommentaireCategorie
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

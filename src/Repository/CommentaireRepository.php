<?php

namespace App\Repository;

use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }

    // /**
    //  * @return Commentaire[] Returns an array of Commentaire objects
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
    public function findOneBySomeField($value): ?Commentaire
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    // public function getCommFiche($id){
    //     $dql='SELECT c.texte, u.pseudo FROM App\Entity\Commentaire c inner join App\Entity\User u inner join App\Entity\Fiche f
    //      where c.user = u.id and f.id='. $id;
    //     $lesCommentaires=$this->getEntityManager()->createQuery($dql)->execute();
    //     return $lesCommentaires;
    // }


    public function getCommNonValid(){
        $dql='SELECT c.id, c.texte, c.isValid, u.pseudo,f.id as ficheId FROM App\Entity\Commentaire c inner join App\Entity\User u inner join App\Entity\Fiche f WHERE c.isValid = false
        and c.user = u.id and c.fiche=f.id';
        $lesCommentaires=$this->getEntityManager()->createQuery($dql)->execute();
        return $lesCommentaires;
    }

    public function getNbComm(){
        $dql='SELECT count(c) as nb from App\Entity\Commentaire c where c.isValid = false';
        $nb=$this->getEntityManager()->createQuery($dql)->execute();
        return $nb;
    }
}

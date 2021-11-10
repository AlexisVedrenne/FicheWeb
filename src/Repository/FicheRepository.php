<?php

namespace App\Repository;

use App\Entity\Fiche;
use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fiche|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fiche|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fiche[]    findAll()
 * @method Fiche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fiche::class);
    }





    public function recherche($value)
    {

        return $this->createQueryBuilder('f')
            ->join(Categorie::class, 'c', 'WITH', 'f.laCategorie=c.id')
            ->Where('f.nom LIKE :lib')
            ->orWhere('c.nom LIKE :val')
            ->setParameter('val', "%" . $value . "%")
            ->setParameter('lib', "%" . $value . "%")

            ->getQuery()
            ->getResult();
    }




    // /**
    //  * @return Fiche[] Returns an array of Fiche objects
    //  */

    public function findByExampleField(string $query)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(
                        $qb->expr()->like('p.nom', ':query'),
                    )
                )
            )
            ->setParameter('query', '%' . $query . '%');
        return $qb
            ->getQuery()
            ->getResult();
    }



    /*
    public function findOneBySomeField($value): ?Fiche
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getCommFiche($idComm)
    {
        $dql = 'SELECT f.id from App\Entity\Fiche f WHERE f.commentaire=' . $idComm;
        return $this->getEntityManager()->createQuery($dql)->execute()[0];
    }
}

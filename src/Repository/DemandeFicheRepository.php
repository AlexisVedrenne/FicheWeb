<?php

namespace App\Repository;

use App\Entity\DemandeFiche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandeFiche|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeFiche|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeFiche[]    findAll()
 * @method DemandeFiche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeFicheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeFiche::class);
    }

    // /**
    //  * @return DemandeFiche[] Returns an array of DemandeFiche objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DemandeFiche
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function getLastDemande(){
        $dql="SELECT d.message,u.pseudo FROM App\Entity\DemandeFiche d inner join App\Entity\User u where d.user = u.id ORDER BY d.id DESC";
        $lesDemandes= $this->getEntityManager()->createQuery($dql)->execute();
        if($lesDemandes !=null){
            $lesDemandes[0]['message']=substr($lesDemandes[0]['message'],0,120);
            $lesDemandes[0]['nb']=count($lesDemandes);
            return $lesDemandes[0];
        }
        else{
            $lesDemandes[0]['pseudo']="Aucun";
            $lesDemandes[0]['message']="Aucune demande disponible";
            $lesDemandes[0]['nb']=0;
            return $lesDemandes[0];
        }
    }
}

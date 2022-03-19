<?php

namespace App\Repository;

use App\Entity\Etudiant;
use App\Entity\EtudiantSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    private function findAllQuery(){
        return $this->createQueryBuilder('e')
            ->where('e.sexe_e = G');
    }
    /**
     * @return Etudiant[]
     */
    public function findAllVisible():array
    {
        return $this->findVisibleQuery()
            ->getQuery()
            ->getResult();
    }
    /**
     * @return Query
     */
    public function findAllVisibleQuery():Query
    {
        return $this->findVisibleQuery()
            ->getQuery();
    }
    /**
     * @return Query
     */
    public function findAllVisibleQuerySearch(EtudiantSearch $search):Query
    {
        $query = $this->findVisibleQuery();
        if ($search->getNomS()){
            $query = $query
                    ->andWhere('e.nom_e = :nomS')
                    ->setParameter('nomS', $search->getNomS());
        }
        /*if ($search->getPrenomS()){
            $query = $query
                ->where('e.prenom_e = :prenomS')
                ->setParameter('prenomS', $search->getPrenomS());
        }*/

        if ($search->getSexeS()){
            $query = $query
                ->andWhere('e.sexe_e = :sexeS')
                ->setParameter('sexeS', $search->getSexeS());
        }
        if ($search->getNationaliteS()){
            $query = $query
                ->andWhere('e.nationalite_e = :nationaliteS')
                ->setParameter('nationaliteS', $search->getNationaliteS());
        }
        /*if ($search->getParain()){
            $query = $query
                ->where('e.parain = :parain')
                ->setParameter('parain', $search->getParain());
        }*/
            return $query->getQuery();
    }
    /**
     * @return Etudiant[]
     */
    public function findLatest():array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Etudiant[]
     */
    public function findLatestAll():array
    {
        return $this->findVisibleQuery()
            //->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }
    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            /* ->where('e.sexe_e = G')*/;
    }
    // /**
    //  * @return Etudiant[] Returns an array of Etudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etudiant
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

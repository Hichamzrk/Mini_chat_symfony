<?php

namespace App\Repository;

use App\Entity\Aime;
use App\Entity\User;
use App\Entity\MGlobal;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method MGlobal|null find($id, $lockMode = null, $lockVersion = null)
 * @method MGlobal|null findOneBy(array $criteria, array $orderBy = null)
 * @method MGlobal[]    findAll()
 * @method MGlobal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MGlobalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MGlobal::class);
    }
    /** 
    * @return MGlobal[] Returns an array of MGlobal objects
    */
    public function FindAllComment()
    {
        return $this->createQueryBuilder('m')
        ->addSelect('a.id')
        ->leftJoin(Aime::class, 'a', 'WITH', 'a.mGlobal = m.id')
        ->getQuery()
        ->getResult();
    }
    // /**
    //  * @return MGlobal[] Returns an array of MGlobal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MGlobal
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

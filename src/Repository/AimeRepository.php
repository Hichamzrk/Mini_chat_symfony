<?php

namespace App\Repository;

use App\Entity\Aime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Aime|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aime|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aime[]    findAll()
 * @method Aime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aime::class);
    }

    // /**
    //  * @return Aime[] Returns an array of Aime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aime
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

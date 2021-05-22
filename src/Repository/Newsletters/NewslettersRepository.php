<?php

namespace App\Repository\Newsletters;

use App\Entity\Newsletters\Newsletters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Newsletters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Newsletters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Newsletters[]    findAll()
 * @method Newsletters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewslettersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Newsletters::class);
    }

    // /**
    //  * @return Newsletters[] Returns an array of Newsletters objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Newsletters
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

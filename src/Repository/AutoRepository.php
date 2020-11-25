<?php

namespace App\Repository;

use App\Entity\Auto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface; 
/**
 * @method Auto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Auto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Auto[]    findAll()
 * @method Auto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutoRepository extends ServiceEntityRepository
{
    private $manager;
    public function __construct(ManagerRegistry $registry ,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Auto::class);
         $this->manager = $manager;
    }
    public function showAuto()
{   
       
    $this->manager->persist();
    $this->manager->flush();
    return $this;
}

    // /**
    //  * @return Auto[] Returns an array of Auto objects
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
    public function findOneBySomeField($value): ?Auto
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

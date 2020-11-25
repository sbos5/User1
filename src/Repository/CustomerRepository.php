<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }
       public function saveCustomer($firstName, $lastName, $email, $phoneNumber)
    {
        $newCustomer = new Customer();

        $newCustomer
            ->setName($firstName)
            ->setSurname($lastName)
            ->setEmail($email)
            ->setPhone($phoneNumber);

        $this->manager->persist($newCustomer);
        $this->manager->flush();
    }
    public function updateCustomer(Customer $customer): Customer
{
    $this->manager->persist($customer);
    $this->manager->flush();

    return $customer;
}
public function removeCustomer(Customer $customer)
{
    $this->manager->remove($customer);
    $this->manager->flush();
}
public function showCustomer(Customer $customer)
{
    $this->manager->FindAll($customer);
    $this->manager->flush();
}

public function showCust(Customer $customer)
{
    $this->manager->Find($customer);
    $this->manager->flush();
}
}
// /**
    //  * @return Customer[] Returns an array of Customer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            -

    /*
    public function findOneBySomeField($value): ?Customer
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


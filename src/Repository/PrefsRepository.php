<?php
namespace App\Repository;

use App\Entity\Prefs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 *
 * @method Prefs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prefs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prefs[] findAll()
 * @method Prefs[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrefsRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Prefs::class);
    }

    // /**
    // * @return Prefs[] Returns an array of Prefs objects
    // */
    /*
     * public function findByExampleField($value)
     * {
     * return $this->createQueryBuilder('p')
     * ->andWhere('p.exampleField = :val')
     * ->setParameter('val', $value)
     * ->orderBy('p.id', 'ASC')
     * ->setMaxResults(10)
     * ->getQuery()
     * ->getResult()
     * ;
     * }
     */

    /*
     * public function findOneBySomeField($value): ?Prefs
     * {
     * return $this->createQueryBuilder('p')
     * ->andWhere('p.exampleField = :val')
     * ->setParameter('val', $value)
     * ->getQuery()
     * ->getOneOrNullResult()
     * ;
     * }
     */
}

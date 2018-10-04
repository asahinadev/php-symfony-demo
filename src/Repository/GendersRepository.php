<?php
namespace App\Repository;

use App\Entity\Genders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 *
 * @method Genders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genders[] findAll()
 * @method Genders[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GendersRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Genders::class);
    }
}

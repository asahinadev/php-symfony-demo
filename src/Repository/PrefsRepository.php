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
}

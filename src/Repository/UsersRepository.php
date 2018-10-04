<?php
namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 *
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[] findAll()
 * @method Users[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Users loadUserByUsername($username)
 * @method Users findByUsername($username)
 * @method Users findByEmail($email)
 * @method bool existsByUsername($username)
 * @method bool existsByEmail($email)
 */
class UsersRepository extends ServiceEntityRepository implements UserLoaderInterface
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function loadUserByUsername($username)
    {
        return $this->findByUsername($username);
    }

    public function findAll($sort = "u.id", $order = "ASC")
    {
        return $this->selectQuery("u.del_flag = '0'", $sort, $order)->getResult();
    }

    public function findByUsername($username)
    {
        return $this->selectQuery("u.username = :username AND u.del_flag = '0'")
            ->setParameter("username", $username)
            ->getOneOrNullResult();
    }

    public function findByEmail($email)
    {
        return $this->selectQuery("u.email = :email AND u.del_flag = '0'")
            ->setParameter("email", $email)
            ->getOneOrNullResult();
    }

    public function existsByEmail($email)
    {
        return ! is_null($this->findByEmail($email));
    }

    public function existsByUsername($username)
    {
        return ! is_null($this->findByUsername($username));
    }

    private function selectQuery($where, $sort = "u.id", $order = "ASC"): Query
    {
        return $this->createQueryBuilder('u')
            ->select()
            ->where($where)
            ->orderBy($sort, $order)
            ->getQuery();
    }
}

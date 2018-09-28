<?php
namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Query;

/**
 *
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[] findAll()
 * @method Users[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository implements UserLoaderInterface
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function loadUserByUsername($username): UserInterface
    {
        return $this->selectQuery("u.username = :username AND u.del_flag = '0'")
            ->setParameter("username", $username)
            ->getSingleResult();
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

    private function selectQuery($where, $sort = "u.id", $order = "ASC"): Query
    {
        return $this->createQueryBuilder('u')
            ->select()
            ->where($where)
            ->orderBy($sort, $order)
            ->getQuery();
    }
}

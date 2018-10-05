<?php
namespace App\EventListener;

use App\Entity\Users;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UsersListener
{

    public function prePersist(Users $user, LifecycleEventArgs $event)
    {
        $em = $event->getEntityManager();
        $rep = $em->getRepository(Users::class);
        $now = new \DateTime();

        $user->setCreated($now);
        $user->setUpdated($now);
        $user->setDelFlag(false);

        $passwordEncoder = $rep->getPasswordEncoder();
        $password = $passwordEncoder->encodePassword($user, $user->getPassword());
        $user->setPassword($password);
    }

    public function preUpdate(Users $user, LifecycleEventArgs $event)
    {
        $em = $event->getEntityManager();
        $rep = $em->getRepository(Users::class);
        $now = new \DateTime();
        $uw = $em->getUnitOfWork();

        $user->setUpdated($now);

        $changes = $uw->getEntityChangeSet($user);
        if (array_key_exists("password", $changes)) {
            $passwordEncoder = $rep->getPasswordEncoder();
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
        }
    }
}


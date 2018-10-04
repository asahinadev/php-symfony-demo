<?php
namespace App\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 *
 * @property Doctrine\Common\Persistence\ManagerRegistry $registry
 * @property Doctrine\Common\Persistence\ObjectManager $em
 * @property Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $encoder
 */
abstract class BaseCommand extends Command
{

    protected $registry;

    protected $em;

    protected $repository;

    protected $encoder;

    public function __construct(ManagerRegistry $registry, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct();

        $this->registry = $registry;
        $this->em = $this->registry->getManager();
        $this->encoder = $encoder;
    }
}

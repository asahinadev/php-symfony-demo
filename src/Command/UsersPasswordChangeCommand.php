<?php
namespace App\Command;

use App\Entity\Users;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 *
 * @property Doctrine\Common\Persistence\ManagerRegistry $registry
 * @property Doctrine\Common\Persistence\ObjectManager $em
 * @property Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $encoder
 * @property App\Repository\UsersRepository $Users
 */
class UsersPasswordChangeCommand extends BaseCommand
{

    protected static $defaultName = 'app:users:password-change';

    public function __construct(ManagerRegistry $registry, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct($registry, $encoder);
        $this->Users = $this->em->getRepository(Users::class);
    }

    protected function configure()
    {
        $this->setDescription('Add a short description for your command')
            ->addArgument('username', InputArgument::REQUIRED, 'login id')
            ->addArgument('password', InputArgument::REQUIRED, 'login password');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $username = $input->getArgument('username');
        $password = $input->getArgument('password');

        $io->writeln(sprintf('You passed an username: %s', $username));
        $io->writeln(sprintf('You passed an password: %s', $password));

        $user = $this->Users->findByUsername($username);
        if ($user) {
            $user->setPassword($this->encoder->encodePassword($user, $password));
            $this->em->flush();

            $io->success(sprintf("save user: %s", $username));
        } else {
            $io->error(sprintf("user not found %s", $username));
        }
    }
}

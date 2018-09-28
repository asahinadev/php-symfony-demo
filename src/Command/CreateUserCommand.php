<?php
namespace App\Command;

use App\Entity\Users;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\UsersRepository;

class CreateUserCommand extends Command
{

    protected static $defaultName = 'app:create-user';

    /**
     *
     * @var ManagerRegistry
     */
    protected $registry;

    /**
     *
     * @var ObjectManager
     */
    protected $em;

    /**
     *
     * @var UsersRepository
     */
    protected $repository;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct();
        $this->registry = $registry;
        $this->em = $this->registry->getManager();
        $this->repository = $this->em->getRepository(Users::class);
    }

    protected function configure()
    {
        $this->setDescription('create new user.')
            ->addArgument('username', InputArgument::REQUIRED, 'login id')
            ->addArgument('password', InputArgument::REQUIRED, 'login password')
            ->addArgument('email', InputArgument::REQUIRED, 'send to password');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $email = $input->getArgument('email');

        $io->writeln(sprintf('You passed an username: %s', $username));
        $io->writeln(sprintf('You passed an password: %s', $password));
        $io->writeln(sprintf('You passed an email   : %s', $email));

        $user = new Users();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setEmail($email);

        $io->note(sprintf('check username: %s', $username));
        $user1 = $this->repository->findByUsername($username);

        $io->note(sprintf('check email   : %s', $email));
        $user2 = $this->repository->findByEmail($email);

        if ($user1) {
            $io->error(sprintf("deplicated username = %s", $username));
        } else if ($user2) {
            $io->error(sprintf("deplicated email    = %s", $email));
        } else {
            $this->em->persist($user);
            $this->em->flush();
        }
    }
}

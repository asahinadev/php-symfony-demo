<?php
namespace App\Command;

use App\Entity\Users;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\UsersRepository;
use Doctrine\Common\Persistence\ObjectManager;

class UpdateUserPasswordCommand extends Command
{

    protected static $defaultName = 'update-user-password';

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

    protected function em(): ObjectManager
    {
        return $this->em;
    }

    /**
     *
     * @var UsersRepository
     */
    protected $repository;

    protected function repository(): UsersRepository
    {
        return $this->repository;
    }

    /**
     *
     * @var UserPasswordEncoderInterface
     */
    protected $encoder;

    public function __construct(ManagerRegistry $registry, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct();

        $this->registry = $registry;
        $this->em = $this->registry->getManager();
        $this->repository = $this->em->getRepository(Users::class);
        $this->encoder = $encoder;
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

        $user = $this->repository->findByUsername($username);
        if ($user) {
            $user->setPassword($this->encoder->encodePassword($user, $password));
            $this->em->flush();
        } else {
            $io->error(sprintf("user not found %s", $username));
        }
    }
}

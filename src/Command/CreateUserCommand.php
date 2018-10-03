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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Genders;
use App\Entity\Prefs;

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
        $user->setPassword($this->encoder->encodePassword($user, $password));
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

            $gendersRepository = $this->em->getRepository(Genders::class);
            $prefsRepository = $this->em->getRepository(Prefs::class);

            // 性別
            $gender = $gendersRepository->find(0);
            $user->setGender($gender);

            // 都道府県
            $pref = $prefsRepository->find(0);
            $user->setPref($pref);

            $this->em->persist($user);
            $this->em->flush();
        }
    }
}

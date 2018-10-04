<?php
namespace App\Command;

use App\Entity\Genders;
use App\Entity\Prefs;
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
 * @property App\Repository\GendersRepository $Genders
 * @property App\Repository\PrefsRepository $Prefs
 */
class UsersCreateCommand extends BaseCommand
{

    protected static $defaultName = 'app:users:create';

    public function __construct(ManagerRegistry $registry, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct($registry, $encoder);

        $this->Users = $this->em->getRepository(Users::class);
        $this->Genders = $this->em->getRepository(Genders::class);
        $this->Prefs = $this->em->getRepository(Prefs::class);
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

        if ($this->Users->existsByUsername($username)) {
            $io->error(sprintf("deplicated username = %s", $username));
        } else if ($this->Users->existsByEmail($email)) {
            $io->error(sprintf("deplicated email    = %s", $email));
        } else {

            // 性別
            $gender = $this->Genders->find(0);
            if ($gender) {
                $user->setGender($gender);
            }

            // 都道府県
            $pref = $this->Prefs->find(0);
            if ($pref) {
                $user->setPref($pref);
            }

            $this->em->persist($user);
            $this->em->flush();

            $io->success(sprintf("save user: %s", $username));
        }
    }
}

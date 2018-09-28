<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\LoginType;
use App\Entity\Users;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class AdminLoginController extends AbstractController
{

    /**
     *
     * @Route("/admin/login", name="admin_login")
     */
    public function index(AuthenticationUtils $auth, LoggerInterface $logger)
    {
        $error = $auth->getLastAuthenticationError();

        if ($error instanceof \Exception) {
            $logger->error($error->getMessage());
            if ($error instanceof UsernameNotFoundException) {
                $logger->error($error->getUsername());
            }
        } else {
            $logger->info("DEFAULT");
        }

        $user = new Users();
        $user->setUsername($auth->getLastUsername());

        $form = $this->createForm(LoginType::class, $user);

        return $this->render('admin_login/index.html.twig', [
            'controller_name' => 'AdminLoginController',
            'error' => $error,
            'form' => $form->createView()
        ]);
    }
}

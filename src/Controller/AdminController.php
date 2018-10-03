<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Psr\Log\LoggerInterface;
use App\Entity\Users;
use App\Form\LoginType;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{

    protected function render(string $view, array $parameters = array(), Response $response = null): Response
    {
        $parameters["controller_name"] = "AdminController";
        return parent::render($view, $parameters, $response);
    }

    /**
     * 管理画面.
     *
     * @Route("/admin", name="admin")
     */
    public function index(LoggerInterface $logger)
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * 管理画面 ログイン.
     *
     *
     * @Route("/admin/login", name="admin_login")
     */
    public function login(AuthenticationUtils $auth, LoggerInterface $logger)
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

        return $this->render('admin/login/index.html.twig', [
            'error' => $error,
            'form' => $form->createView()
        ]);
    }

    /**
     * 管理画面 ログアウト.
     *
     *
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logout(LoggerInterface $logger)
    {
        return $this->render('admin/logout/index.html.twig');
    }
}

<?php
namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UsersType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 *
 * @Route("/admin/users")
 */
class AdminUsersController extends AbstractController
{

    protected function render(string $view, array $parameters = array(), Response $response = null): Response
    {
        $parameters["controller_name"] = "AdminUsersController";
        return parent::render($view, $parameters, $response);
    }

    /**
     * 管理画面 ユーザー管理（一覧）.
     *
     * @Route("/", name="admin_users", methods="GET")
     */
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('admin/users/index.html.twig', [
            'users' => $usersRepository->findAll()
        ]);
    }

    /**
     * 管理画面 ユーザー管理（登録）.
     *
     * @Route("/new", name="admin_users_new", methods="GET|POST")
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // パスワードエンコード
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_users_edit', [
                'id' => $user->getId()
            ]);
        }

        return $this->render('admin/users/new.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * 管理画面 ユーザー管理（詳細）.
     *
     * @Route("/{id}", name="admin_users_show", methods="GET")
     */
    public function show(Users $user): Response
    {
        return $this->render('admin/users/show.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * 管理画面 ユーザー管理（更新）.
     *
     * @Route("/{id}/edit", name="admin_users_edit", methods="GET|POST")
     */
    public function edit(Request $request, Users $user, UserPasswordEncoderInterface $encoder): Response
    {
        $oldPass = $user->getPassword();

        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $doctrine = $this->getDoctrine();

            if (strcmp($oldPass, $user->getPassword()) !== 0) {
                // パスワードエンコード
                $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            }

            $doctrine->getManager()->flush();

            return $this->redirectToRoute('admin_users_edit', [
                'id' => $user->getId()
            ]);
        }

        return $this->render('admin/users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * 管理画面 ユーザー管理（削除）.
     *
     * @Route("/{id}", name="admin_users_delete", methods="DELETE")
     */
    public function delete(Request $request, Users $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $user->setDelFlag("1");

            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->redirectToRoute('admin_users');
    }
}

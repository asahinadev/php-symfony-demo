<?php
namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UsersType;

/**
 *
 * @Route("/admin/users")
 */
class AdminUsersController extends AbstractController
{

    /**
     *
     * @Route("/", name="admin_users", methods="GET")
     */
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('admin_users/index.html.twig', [
            'controller_name' => 'AdminUsersController',
            'users' => $usersRepository->findAll()
        ]);
    }

    /**
     *
     * @Route("/new", name="admin_users_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_users_edit', [
                'id' => $user->getId()
            ]);
        }

        return $this->render('admin_users/new.html.twig', [
            'controller_name' => 'AdminUsersController',
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/{id}", name="admin_users_show", methods="GET")
     */
    public function show(Users $user): Response
    {
        return $this->render('admin_users/show.html.twig', [
            'controller_name' => 'AdminUsersController',
            'user' => $user
        ]);
    }

    /**
     *
     * @Route("/{id}/edit", name="admin_users_edit", methods="GET|POST")
     */
    public function edit(Request $request, Users $user): Response
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()
                ->getManager()
                ->flush();

            return $this->redirectToRoute('admin_users_edit', [
                'id' => $user->getId()
            ]);
        }

        return $this->render('admin_users/edit.html.twig', [
            'controller_name' => 'AdminUsersController',
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     *
     * @Route("/{id}", name="admin_users_delete", methods="DELETE")
     */
    public function delete(Request $request, Users $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('admin_users');
    }
}

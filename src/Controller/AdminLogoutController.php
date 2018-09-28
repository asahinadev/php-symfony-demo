<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminLogoutController extends AbstractController
{

    /**
     *
     * @Route("/admin/logout", name="admin_logout")
     */
    public function index()
    {
        return $this->render('admin_logout/index.html.twig', [
            'controller_name' => 'AdminLogoutController'
        ]);
    }
}

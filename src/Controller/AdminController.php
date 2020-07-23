<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index():Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');



        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/user", name="user")
     * @param UserRepository $user
     * @return Response
     */
    public function userList(UserRepository $user)
    {
        return $this->render('admin/user.html.twig', [
            'user' => $user->findAll(),
        ]);
    }



}
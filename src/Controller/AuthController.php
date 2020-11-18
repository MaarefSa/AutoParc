<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use FOS\RestBundle\Controller\Annotations as FOSRest;

class AuthController extends AbstractController
{

    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $role = $request->request->get('role');
        $user = new User($username);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setRole($role);
        $em->persist($user);
        $em->flush();
        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }
    public function api()
    {
        //return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
       //  return $this->json($this->getUser()->getRole());
        $roleuser = $this->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository(User::class);

        // query for a single Product by its primary key (usually "id")
        $role = $repository->find($roleuser);
        $response = new Response(json_encode($role));
        return $response;
    }
//
       /**
        * Lists user.
        * @FOSRest\Get("/showUser")
        *
        * @return array
        */
    public function getUserAction()
    {
        $roless = $this->getUser()->getRole();
        $repository = $this->getDoctrine()->getRepository(User::class);

        // query for a single Product by its primary key (usually "id")
        $role = $repository->findBy($roless);
        $roles = $this->getDoctrine()->getManager($role);
        //  $response = new Response(json_encode($vehicule));
        //  return $response;
        return $this->json($roles);
        // return View::create($article, Response::HTTP_OK , []);
    }
}

<?php

namespace App\Controller;

use App\Entity\Affectation;
use App\Entity\Consommation;
use App\Repository\AffectationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as FOSRest;


/**
 * @Route("/api/consommation", name="consommation")
 */
class ConsommationController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ConsommationController.php',
        ]);
    }
    /**
     * Lists all Consommation.
     * @FOSRest\Get("/show")
     *
     * @return array
     */
    public function getConsommationAction()
    {
        $repository = $this->getDoctrine()->getRepository(Consommation::class);

        // query for a single Product by its primary key (usually "id")
        $consommation = $repository->findall();
        //  $response = new Response(json_encode($vehicule));
        //  return $response;
        return $this->json($consommation);
        // return View::create($article, Response::HTTP_OK , []);
    }

    /**
     * get consommation by id .
     * @FOSRest\Get("/showById/{id}")
     *
     * @return array
     */
    public function getConsommationByIdAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Consommation::class);

        // query for a single Product by its primary key (usually "id")
        $consommation = $repository->find($id);
        //  $response = new Response(json_encode($vehicule));
        //  return $response;
        return $this->json($consommation);
        // return View::create($article, Response::HTTP_OK , []);
    }

    /**
     * Create Consommation.
     * @FOSRest\Post("/create")
     *
     * @return array
     */
    public function postConsommationAction(Request $request,AffectationRepository $repo)
    {
        $consommation = new Consommation();
        $consommation->setReference($request->get('reference'));
        $consommation->setCarburant($request->get('carburant'));
        $consommation->setHuile($request->get('huile'));
        $consommation->setFixe($request->get('fixe'));
        $consommation->setDivers($request->get('divers'));
        $consommation->setAffectation($repo->find($request->get('affectation')));
        $em = $this->getDoctrine()->getManager();
        $em->persist($consommation);
        $em->flush();
        //  return View::create($article, Response::HTTP_CREATED , []);
        //return new Response(['data'=> "okkk"]);
        $response = new Response(json_encode($consommation));

        return $response;

    }

    /**
     * Edit Consommation.
     * @FOSRest\Post("/edit/{id}")
     *
     * @return array
     */
    public function editConsommationAction(Request $request , $id,AffectationRepository $repo)
    {
        $consommation = $this->getDoctrine()->getRepository(Consommation::class)->find($id);
        $consommation->setReference($request->get('reference'));
        $consommation->setCarburant($request->get('carbrant'));
        $consommation->setHuile($request->get('huile'));
        $consommation->setFixe($request->get('fixe'));
        $consommation->setDivers($request->get('divers'));
        $consommation->setAffectation($repo->find($request->get('affectation')));
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        //  return View::create($article, Response::HTTP_CREATED , []);
        //return new Response(['data'=> "okkk"]);
        $response = new Response(json_encode($consommation));

        return $response;

    }

    /**
     * Delete Consommation.
     * @FOSRest\Delete("/delete/{id}")
     *
     * @return array
     */
    public function deleteCosommationAction(Request $request , $id)
    {
        $consommation = $this->getDoctrine()->getRepository(Consommation::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($consommation);
        $em->flush();

        $response = new Response(json_encode($consommation));
        $response->send();
        return $response;


    }


}

<?php

namespace App\Controller;

use App\Entity\Affectation;
use App\Repository\ChauffeurRepository;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as FOSRest;

/**
 * @Route("/api/affectation", name="affectation")
 */
class AffectationController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AffectationController.php',
        ]);
    }


    /**
     * Lists all Affectation.
     * @FOSRest\Get("/show")
     *
     * @return array
     */
    public function getAffectationAction()
    {
        $repository = $this->getDoctrine()->getRepository(Affectation::class);

        // query for a single Product by its primary key (usually "id")
        $affectation = $repository->findall();
        //  $response = new Response(json_encode($vehicule));
        //  return $response;
        return $this->json($affectation);
        // return View::create($article, Response::HTTP_OK , []);
    }
    /**
     * get affectation by id .
     * @FOSRest\Get("/showById/{id}")
     *
     * @return array
     */
    public function getAffectationByIdAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Affectation::class);

        // query for a single Product by its primary key (usually "id")
        $affectation = $repository->find($id);
        //  $response = new Response(json_encode($vehicule));
        //  return $response;
        return $this->json($affectation);
        // return View::create($article, Response::HTTP_OK , []);
    }

    /**
     * Create Affectation.
     * @FOSRest\Post("/create")
     *
     * @return array
     */
    public function postAffectationAction(Request $request, VehiculeRepository $repo, ChauffeurRepository $repoC)
    {

        $affectation = new Affectation();
        $affectation->setCodeMission($request->get('codeMission'));
        $affectation->setDebutAffect($request->get('debutAffect'));
        $affectation->setFinAffectPrevue($request->get('finAffectPrevue'));
        $affectation->setFinAffectReelle($request->get('finAffectReelle'));
        $affectation->setDirection($request->get('direction'));
        $affectation->setAdresse($request->get('adresse'));
        $affectation->setVehicule($repo->find($request->get('vehicule')));
        $affectation->setChauffeur($repoC->find($request->get('chauffeur')));
        $em = $this->getDoctrine()->getManager();
        $em->persist($affectation);
        $em->flush();
        //  return View::create($article, Response::HTTP_CREATED , []);
        //return new Response(['data'=> "okkk"]);
        $response = new Response(json_encode($affectation));

        return $response;

    }

    /**
     * Edit Affetation.
     * @FOSRest\Post("/edit/{id}")
     *
     * @return array
     */
    public function editAffetationAction(Request $request , $id,VehiculeRepository $repo, ChauffeurRepository $repoC)
    {
        $affectation = $this->getDoctrine()->getRepository(Affectation::class)->find($id);

        $affectation->setCodeMission($request->get('codeMission'));
        $affectation->setDebutAffect($request->get('debutAffect'));
        $affectation->setFinAffectPrevue($request->get('finAffectPrevue'));
        $affectation->setFinAffectReelle($request->get('finAffectReelle'));
        $affectation->setDirection($request->get('direction'));
        $affectation->setAdresse($request->get('adresse'));
        $affectation->setVehicule($repo->find($request->get('vehicule')));
        $affectation->setChauffeur($repoC->find($request->get('chauffeur')));
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        //  return View::create($article, Response::HTTP_CREATED , []);
        //return new Response(['data'=> "okkk"]);
        $response = new Response(json_encode($affectation));

        return $response;

    }

    /**
     * Delete Affectation.
     * @FOSRest\Delete("/delete/{id}")
     *
     * @return array
     */
    public function deleteChauffeurAction(Request $request , $id)
    {
        $affectation = $this->getDoctrine()->getRepository(Affectation::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($affectation);
        $em->flush();

        $response = new Response(json_encode($affectation));
        $response->send();
        return $response;


    }



}

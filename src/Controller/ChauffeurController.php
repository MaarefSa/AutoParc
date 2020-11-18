<?php

namespace App\Controller;

use App\Entity\Chauffeur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as FOSRest;

/**
 * @Route("/api/conducteur", name="commande")
 */
class ChauffeurController extends AbstractController
{
    /**
     * @Route("/home", name="chauffeur")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ChauffeurController.php',
        ]);
    }

    /**
     * Lists all Chauffeur.
     * @FOSRest\Get("/show")
     *
     * @return array
     */
    public function getChauffeurAction()
    {
        $repository = $this->getDoctrine()->getRepository(Chauffeur::class);

        // query for a single Product by its primary key (usually "id")
        $chauffeur = $repository->findall();
        //  $response = new Response(json_encode($vehicule));
        //  return $response;
        return $this->json($chauffeur);
        // return View::create($article, Response::HTTP_OK , []);
    }
    /**
     * get chauffeur by id .
     * @FOSRest\Get("/showById/{id}")
     *
     * @return array
     */
    public function getChauffeurByIdAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Chauffeur::class);

        // query for a single Product by its primary key (usually "id")
        $chauffeur = $repository->find($id);
        //  $response = new Response(json_encode($vehicule));
        //  return $response;
        return $this->json($chauffeur);
        // return View::create($article, Response::HTTP_OK , []);
    }

    /**
     * Create Chauffeur.
     * @FOSRest\Post("/create")
     *
     * @return array
     */
    public function postChauffeurAction(Request $request)
    {
        $chauffeur = new Chauffeur();
        $chauffeur->setMatricule($request->get('matricule'));
        $chauffeur->setNom($request->get('nom'));
        $chauffeur->setPrenom($request->get('prenom'));
        $chauffeur->setNumPermis($request->get('numPermis'));
        $chauffeur->setDateFunction($request->get('dateFunction'));
        $chauffeur->setTelephone($request->get('telephone'));
        $chauffeur->setAdresse($request->get('adresse'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($chauffeur);
        $em->flush();
        //  return View::create($article, Response::HTTP_CREATED , []);
        //return new Response(['data'=> "okkk"]);
        $response = new Response(json_encode($chauffeur));

        return $response;

    }

    /**
     * Edit Chauffeur.
     * @FOSRest\Post("/edit/{id}")
     *
     * @return array
     */
    public function editChauffeurAction(Request $request , $id)
    {
        $chauffeur = $this->getDoctrine()->getRepository(Chauffeur::class)->find($id);


        $chauffeur->setMatricule($request->get('matricule'));
        $chauffeur->setNom($request->get('nom'));
        $chauffeur->setPrenom($request->get('prenom'));
        $chauffeur->setNumPermis($request->get('numPermis'));
        $chauffeur->setDateFunction($request->get('dateFunction'));
        $chauffeur->setTelephone($request->get('telephone'));
        $chauffeur->setAdresse($request->get('adresse'));
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        //  return View::create($article, Response::HTTP_CREATED , []);
        //return new Response(['data'=> "okkk"]);
        $response = new Response(json_encode($chauffeur));

        return $response;

    }

    /**
     * Delete Chauffeur.
     * @FOSRest\Delete("/delete/{id}")
     *
     * @return array
     */
    public function deleteChauffeurAction(Request $request , $id)
    {
        $chauffeur = $this->getDoctrine()->getRepository(Chauffeur::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($chauffeur);
        $em->flush();

        $response = new Response(json_encode($chauffeur));
        $response->send();
        return $response;


    }

}

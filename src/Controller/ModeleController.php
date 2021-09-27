<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Modele;
use App\Exception\FormExeption;
use App\Form\ModeleType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ModeleRepository;
use JMS\Serializer\SerializerInterface;

class ModeleController extends AbstractController
{
    public function __construct(ModeleRepository $repository,  EntityManagerInterface  $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager =  $entityManager;
    }

    public function index(ModeleRepository $repository)
    {
        $Modele = $repository->transformAll();
        return $this->respond($Modele);
    }

    /**
     * @Route("/modele", name="createModele",methods="POST")
     */

    public function createModele(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $modele = new Modele();
        $form = $this->createForm(ModeleType::class, $modele);

        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager  = $this->getDoctrine()->getManager();

            $entityManager->persist($modele);

            $entityManager->flush();
        }
        $response = array(

            'code' => 0,
            'message' => 'created with success!',
            'errors' => null,
            'result' => null

        );

        return new JsonResponse($response, Response::HTTP_CREATED);
    }
    /**
     * @Route("/modele/{id}", name="show",methods="GET")
     */
    public function show(int $id): Response
    {
        $modele = $this->getDoctrine()
            ->getRepository(Modele::class)
            ->find($id);

        if (!$modele) {
            throw $this->createNotFoundException(
                'No Modele found for id ' . $id
            );
        }

        return new Response('Check out this Modele: ' . $modele->getNom());
    }

    /**
     * @Route("/modele/{id}",name="update", methods="PUT")
     */
    public function update(int $id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $modele = $this->getDoctrine()
            ->getRepository(Modele::class)
            ->find($id);
        if (!$modele) {
            throw $this->createNotFoundException(
                'No Modele found for id ' . $id
            );
        }
        $form = $this->createForm(ModeleType::class, $modele);
        $form->handleRequest($request);
        $form->submit($data);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }
        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
        }
        $response = array(

            'code' => 0,
            'message' => 'update with success!',
            'errors' => null,
            'result' => null

        );
        return new JsonResponse($response, Response::HTTP_CREATED);
    }

    /**
   
     * @Route("/modele/{id}", name="deleteModele",methods={"DELETE"})
     *

     */
    public function deleteModele($id): JsonResponse
    {

        $modele = new Modele();
        $entityManager = $this->getDoctrine()->getManager();
        $modele = $this->getDoctrine()
            ->getRepository(Modele::class)
            ->find($id);
        if (!$modele) {
            throw $this->createNotFoundException(
                'No Modele found for id ' . $id
            );
        }
        $entityManager->remove($modele);
        $entityManager->flush();
        return new JsonResponse(['status' => 'Modele deleted']);
    }
}

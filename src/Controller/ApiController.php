<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/", name="root")
     */
    public function index()
    {
        return $this->render('api/index.html.twig');
    }

    /**
     * @Route("/recettes", name="recettes")
     */
    public function recettes()
    {
        $recettes = new Recette();
        $recettes = $this->getDoctrine()->getRepository(Recette::class)->findAll();


        return $this->json($recettes, 200, []);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request)
    {
        $recette = new Recette();

        $form = $this->createForm(RecetteType::class, $recette);

        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            
            $manager->persist($recette);
            $manager->flush();

            return $this->redirectToRoute("list");
        }

        return $this->render('api/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/list", name="list")
     */
    public function list()
    {
        $repository = $this->getDoctrine()->getRepository(Recette::class);

        $recettes = $repository->findAll();

        return $this->render("api/list.html.twig", [
            "recettes" => $recettes
        ]);
    }

    /**
     * @Route("/list/{id}", name="recette")
     */
    public function recette($id)
    {
        $repository = $this->getDoctrine()->getRepository(Recette::class);

        $recette = $repository->find($id);

        return $this->render("api/recette.html.twig", [
            "recette" => $recette,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit($id, Request $request)
    {
        $recette = new Recette();

        $recette = $this->getDoctrine()->getRepository(Recette::class)->find($id);

        $form = $this->createForm(RecetteType::class, $recette);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();

            $manager -> persist($recette);
            $manager -> flush();

            return $this->redirectToRoute("list");
        }

        return $this->render("api/edit.html.twig", [
            "recette" => $recette,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id)
    {
        $recette = new Recette();

        $recette = $this->getDoctrine()->getRepository(Recette::class)->find($id);

        $manager = $this->getDoctrine()->getManager();

        $manager->remove($recette);
        $manager->flush();

        return $this->redirectToRoute("list");
    }
}

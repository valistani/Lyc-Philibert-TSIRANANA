<?php

namespace App\Controller\Admin;

use App\Entity\Tuteur;
use App\Form\TuteurType;
use App\Repository\TuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/tuteur")
 */
class AdminTuteurController extends AbstractController
{
    /**
     * @Route("/", name="admin.tuteur.index", methods={"GET"})
     */
    public function index(TuteurRepository $tuteurRepository): Response
    {
        return $this->render('admin/tuteur/index.html.twig', [
            'tuteurs' => $tuteurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.tuteur.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tuteur = new Tuteur();
        $form = $this->createForm(TuteurType::class, $tuteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tuteur);
            $entityManager->flush();

            $this->addFlash('success','Bien crée avec succès');
            return $this->redirectToRoute('admin.tuteur.index');
        }

        return $this->render('admin/tuteur/new.html.twig', [
            'tuteur' => $tuteur,
            'form' => $form->createView(),
        ]);
    }
/*
    /**
     * @Route("/{id}", name="admin.tuteur.show", methods={"GET"})
     */
    /*public function show(Tuteur $tuteur): Response
    {
        return $this->render('admin/tuteur/show.html.twig', [
            'tuteur' => $tuteur,
        ]);
    }*/

    /**
     * @Route("/{id}/edit", name="admin.tuteur.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tuteur $tuteur): Response
    {
        $form = $this->createForm(TuteurType::class, $tuteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success','Bien modifié avec succès');
            return $this->redirectToRoute('admin.tuteur.index');
        }

        return $this->render('admin/tuteur/edit.html.twig', [
            'tuteur' => $tuteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.tuteur.delete", methods={"POST"})
     */
    public function delete(Request $request, Tuteur $tuteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tuteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tuteur);
            $entityManager->flush();
            $this->addFlash('success','Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.tuteur.index');
    }
}

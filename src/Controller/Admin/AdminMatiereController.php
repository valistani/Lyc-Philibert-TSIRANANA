<?php

namespace App\Controller\Admin;

use App\Entity\Matiere;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/matiere")
 */
class AdminMatiereController extends AbstractController
{
    /**
     * @Route("/", name="admin.matiere.index", methods={"GET"})
     */
    public function index(MatiereRepository $matiereRepository): Response
    {
        return $this->render('admin/matiere/index.html.twig', [
            'matieres' => $matiereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.matiere.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $matiere = new Matiere();
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($matiere);
            $entityManager->flush();

            $this->addFlash('success','Bien crée avec succès');
            return $this->redirectToRoute('admin.matiere.index');
        }

        return $this->render('admin/matiere/new.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /*/**
     * @Route("/{id}", name="admin.matiere.show", methods={"GET"})
     */
    /*public function show(Matiere $matiere): Response
    {
        return $this->render('admin/matiere/show.html.twig', [
            'matiere' => $matiere,
        ]);
    }*/

    /**
     * @Route("/{id}/edit", name="admin.matiere.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Matiere $matiere): Response
    {
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success','Bien modifié avec succès');
            return $this->redirectToRoute('admin.matiere.index');
        }

        return $this->render('admin/matiere/edit.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.matiere.delete", methods={"POST"})
     */
    public function delete(Request $request, Matiere $matiere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($matiere);
            $entityManager->flush();
            $this->addFlash('success','Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.matiere.index');
    }
}

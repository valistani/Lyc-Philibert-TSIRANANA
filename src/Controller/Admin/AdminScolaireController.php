<?php

namespace App\Controller\Admin;

use App\Entity\Scolaire;
use App\Form\ScolaireType;
use App\Repository\ScolaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/scolaire")
 */
class AdminScolaireController extends AbstractController
{
    /**
     * @Route("/", name="admin.scolaire.index", methods={"GET"})
     */
    public function index(ScolaireRepository $scolaireRepository): Response
    {
        return $this->render('admin/scolaire/index.html.twig', [
            'scolaires' => $scolaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.scolaire.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $scolaire = new Scolaire();
        $form = $this->createForm(ScolaireType::class, $scolaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($scolaire);
            $entityManager->flush();

            $this->addFlash('success','Bien crée avec succès');
            return $this->redirectToRoute('admin.scolaire.index');
        }

        return $this->render('admin/scolaire/new.html.twig', [
            'scolaire' => $scolaire,
            'form' => $form->createView(),
        ]);
    }
/*
    /**
     * @Route("/{id}", name="admin.scolaire.show", methods={"GET"})
     */
    /*public function show(Scolaire $scolaire): Response
    {
        return $this->render('admin/scolaire/show.html.twig', [
            'scolaire' => $scolaire,
        ]);
    }*/

    /**
     * @Route("/{id}/edit", name="admin.scolaire.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Scolaire $scolaire): Response
    {
        $form = $this->createForm(ScolaireType::class, $scolaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success','Bien modifiée avec succès');
            return $this->redirectToRoute('admin.scolaire.index');
        }

        return $this->render('admin/scolaire/edit.html.twig', [
            'scolaire' => $scolaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.scolaire.delete", methods={"POST"})
     */
    public function delete(Request $request, Scolaire $scolaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$scolaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($scolaire);
            $entityManager->flush();
            $this->addFlash('success','Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.scolaire.index');
    }
}

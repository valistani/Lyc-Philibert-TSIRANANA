<?php

namespace App\Controller\Admin;

use App\Entity\Parain;
use App\Form\ParainType;
use App\Repository\ParainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/parain")
 */
class AdminParainController extends AbstractController
{
    /**
     * @Route("/", name="admin.parain.index", methods={"GET"})
     */
    public function index(ParainRepository $parainRepository): Response
    {
        return $this->render('admin/parain/index.html.twig', [
            'parains' => $parainRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.parain.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $parain = new Parain();
        $form = $this->createForm(ParainType::class, $parain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parain);
            $entityManager->flush();
            $this->addFlash('success','Bien crée avec succès');
            return $this->redirectToRoute('admin.etudiant.new');
        }

        return $this->render('admin/parain/new.html.twig', [
            'parain' => $parain,
            'form' => $form->createView(),
        ]);
    }
/*
    /**
     * @Route("/{id}", name="admin.parain.show", methods={"GET"})
     */
   /* public function show(Parain $parain): Response
    {
        return $this->render('admin/parain/show.html.twig', [
            'parain' => $parain,
        ]);
    }
*/
    /**
     * @Route("/{id}/edit", name="admin.parain.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Parain $parain): Response
    {
        $form = $this->createForm(ParainType::class, $parain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','Bien modifié avec succès');
            return $this->redirectToRoute('admin.parain.index');
        }

        return $this->render('admin/parain/edit.html.twig', [
            'parain' => $parain,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.parain.delete", methods={"POST"})
     */
    public function delete(Request $request, Parain $parain): Response
    {
        if ($this->isCsrfTokenValid('admin/delete'.$parain->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parain);
            $entityManager->flush();
            $this->addFlash('success','Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.parain.index');
    }
}

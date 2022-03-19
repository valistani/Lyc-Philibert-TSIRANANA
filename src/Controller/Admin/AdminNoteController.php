<?php


namespace App\Controller\Admin;
use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/admin/note")
 */
class AdminNoteController extends AbstractController
{
    /**
     * @var Environment;
     */
    private $twig;
    public  function __construct($twig)
    {
        $this->twig = $twig;
    }
    /**
     * @Route("/", name="admin.note.index", methods={"GET"})
     */
    public function index(NoteRepository $repository): Response
    {
        /*return $this->render('admin/note/index.html.twig', [
            'notes' => $noteRepository->findAll(),
        ]);*/
        $notes = $repository->findAll();
        return new Response($this->twig->render('admin/note/index.html.twig',[
            'notes' => $notes
        ]));
    }

    /**
     * @Route("/new", name="admin.note.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($note);
            $entityManager->flush();

            $this->addFlash('success','Bien crée avec succès');
            return $this->redirectToRoute('admin.note.index');
        }

        return $this->render('admin/note/new.html.twig', [
            'note' => $note,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.note.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Note $note): Response
    {
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success','Bien modifié avec succès');
            return $this->redirectToRoute('admin.note.index');
        }

        return $this->render('admin/note/edit.html.twig', [
            'note' => $note,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.note.delete", methods={"POST"})
     */
    public function delete(Request $request, Note $note): Response
    {
        if ($this->isCsrfTokenValid('delete'.$note->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($note);
            $entityManager->flush();
            $this->addFlash('success','Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.note.index');
    }
}
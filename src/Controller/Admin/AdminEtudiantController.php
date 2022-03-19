<?php
namespace App\Controller\Admin;

use App\Controller\EtudiantController;
use App\Entity\Etudiant;
use App\Entity\EtudiantSearch;
//use App\Entity\Parain;
use App\Form\EtudiantSearchType;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
//use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class AdminEtudiantController extends  AbstractController {

    /**
     * @var EtudiantRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    //private $em;

    public function __construct(EtudiantRepository $repository/*, ObjectManager $em*/){

        $this->repository = $repository;
        //$this->em = $em;
    }

    /**
     * @Route ("/admin",name="admin.etudiant.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request){
        $search = new EtudiantSearch();
        $form = $this->createForm(EtudiantSearchType::class, $search);
        $form->handleRequest($request);
        $show = EtudiantController::class;
        //$show->show();
        //$etudiants = $this->repository->findAll();
        $etudiants = $paginator->paginate(
            $this->repository->findAllVisibleQuerySearch($search),
            $request->query->getInt('page', 1),7
        );
        return $this->render('admin/etudiant/index.html.twig', /*compact('etudiants' )*/[
            'etudiants' => $etudiants,
            'show' => $show,
            'form'      => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/etudiant/create", name="admin.etudiant.new")
     */
    public function new(Request $request){
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /****************Sauvegarde edition ******************/
            $em =  $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();
            $this->addFlash('success','Bien crée avec succès');
            /**************** End Sauvegarde edition ******************/
            return  $this->redirectToRoute('admin.etudiant.index');
        }
        return $this->render('admin/etudiant/new.html.twig',[
            'etudiant' => $etudiant,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route ("/admin/etudiant/{id}", name="admin.etudiant.edit", methods="GET|POST")
     * @param Etudiant $etudiant
     * @param Request $request
     * @return Response
     */
    public function edit(Etudiant $etudiant, Request $request/*, CacheManager $cacheManager, UploaderHelper $helper*/){

        //$parain = new Parain();
        //$etudiant->setParain($parain);
        /*$parain = new Parain();
        $etudiant->addEtudiant($parain);*/

        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /*if ($etudiant->getImageFile() instanceof UploadedFile) {
                $cacheManager->remove($helper->asset($etudiant, 'imageFile'));
            }*/
            /****************Sauvegarde edition ******************/
            $em =  $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Bien modifié avec succès');
            /**************** End Sauvegarde edition ******************/
            //return  $this->redirectToRoute('admin.etudiant.index');
            return  $this->redirectToRoute('/admin/parain/new.html.twig');
        }
        return $this->render('admin/etudiant/edit.html.twig',[
            'etudiant' => $etudiant,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/etudiant/{id}", name="admin.etudiant.delete")
     * @param Etudiant $etudiant
     *  @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Etudiant  $etudiant, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $etudiant->getId(), $request->get('_token'))){
            $em =  $this->getDoctrine()->getManager();
            $em->remove($etudiant);
            $em->flush();
            $this->addFlash('success','Bien supprimé avec succès');
            //return  new \Symfony\Component\HttpFoundation\Response('Suppression');

        }
        return $this->redirectToRoute('admin.etudiant.index');

    }
}
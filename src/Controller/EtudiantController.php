<?php


namespace App\Controller;


use App\Entity\Etudiant;
use App\Entity\EtudiantSearch;
use App\Entity\Parain;
use App\Form\EtudiantSearchType;
use App\Repository\EtudiantRepository;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{

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
        // $this->em = $em;
    }

    /**
     * @Route ("/etudiant", name="etudiant.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response{
        //$etudiant = $this->repository->findAll();
        #$etudiant = $this->repository->findAllVisible();
        //$etudiants = $this->repository->findAll();
        //dump($etudiant);
        /*$etudiant[0]->setSexeE('F');
        $this->em->flush();*/
        /*$etudiant = new Etudiant();
        $etudiant->setNomE('RAKOTONANDRASANA')
                 ->setPrenomE('Jean')
                 //->setDateNaissanceE(2021-12-05)
                 ->setSexeE('G')
                 ->setAddresseE('0212F0100 Tanambao SOTEMA');
        $em = $this->getDoctrine()->getManager();
        $em->persist($etudiant);
        $em->flush();*/
        /*$repository = $this->getDoctrine()->getRepository(Etudiant::class);
        dump($repository);*/
        $etudiants = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),9
        );
        return $this->render('etudiant/index.html.twig',[
            'current_menu' => 'etudiants',
            'etudiants' => $etudiants
        ]);
    }

    /**
     * @Route ("/etudiant/{slug}-{id}", name="etudiant.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(/*$slug, $id */ Etudiant $etudiant, string $slug):Response
    {

        if ($etudiant->getSlug() !== $slug){
            return $this->redirectToRoute('etudiant.show',[
                'id' => $etudiant->getId(),
                'slug' => $etudiant->getSlug()
            ],301);

        }
        //$etudiant = $this->repository->find($id);
        //$etudiant = $this->repository->findJointure();
        $parain = new Parain();
        return $this->render('etudiant/show.html.twig',[
            'etudiant' => $etudiant,
            'current_menu' => 'etudiants',
            'parains' => $parain
        ]);
    }
}
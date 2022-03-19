<?php


namespace App\Controller;
use App\Repository\EtudiantRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AccueilController extends AbstractController
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
     * @Route ("/", name="accueil")
     * @param EtudiantRepository $repository
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(EtudiantRepository $repository,PaginatorInterface $paginator, Request $request):Response{
        //$etudiants = $repository->findLatest();
        //$etudiants = $repository->findLatestAll();
        $etudiants = $paginator->paginate(
            $repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),8
        );
        return new Response($this->twig->render('pages/accueil.html.twig',[
            'etudiants' => $etudiants
        ]));
    }

}
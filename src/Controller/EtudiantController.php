<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Etudiants;
use App\Repository\EtudiantsRepository;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/etudiant")
 * @IsGranted("ROLE_USER")
 */
class EtudiantController extends AbstractController
{

    #[Route('/', name: 'app_etudiant')]
    public function index(EtudiantsRepository $etudiantRepo): Response
    {
        $is_stud = false; // variable d'etat

        $etudiant = $etudiantRepo->findOneBy(['possesseur'=>$this->getUser()]); // ici on essaye de recuperer les informations de l'etudiant qui est actuellement connecte ! 


        if($etudiant != null) $is_stud = true; // on verifi si ses infos sy trouvent ou pas! si il y en a, on met la variable d'etat a true

        if($is_stud == false){ // si il n'est pas encore enregistrer
            return $this->redirectToRoute('app_save_stud'); // on le redirige vers le controlleur qui doit l'enregistrer
        }

        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }

    /**
     * @Route("/end-signin", name="app_save_stud")
     */
    public function app_save_stud(EtudiantsRepository $etudiantRepo){
        
        return $this->render('etudiant/app_save_stud.html.twig');
    }

    
    #[Route('/app_save_etudiant', name: 'app_save_etudiant', methods: ['GET', 'POST'])]
    public function app_save_etudiant(EtudiantsRepository $etudiantRepo, Request $request){
        $datas = $request->request->all();
        $etudiant = new Etudiants();
        $etudiant->setPossesseur($this->getUser());
        $etudiant->setFiliere($datas['filiere']);
        $etudiant->setNiveau($datas['niveau']);
        $etudiant->setDiplome($datas['diplome']);
        $etudiant->setDernierEtablissement($datas['etablissement']);
        $etudiant->setStatut('actif');

        $etudiantRepo->add($etudiant);

        return $this->redirectToRoute('app_etudiant');
    }

}

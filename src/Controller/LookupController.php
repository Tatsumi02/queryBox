<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * 
 * @IsGranted("ROLE_USER")
 */
class LookupController extends AbstractController
{
    #[Route('/lookup', name: 'app_lookup')]
    public function index(): Response
    {

        if($this->getUser()->getRoles()[0] == 'ROLE_USER'){
            return $this->redirectToRoute('app_etudiant');
        }

        if($this->getUser()->getRoles()[0] == 'ROLE_ADMIN'){
            return $this->redirectToRoute('app_admin');
        }

        if($this->getUser()->getRoles()[0] == 'ROLE_ROOT'){
            return $this->redirectToRoute('app_root');
        }

        return $this->render('lookup/index.html.twig', [
            'controller_name' => 'LookupController',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // quand l'appli est lancer, on rredirige l'utilisateur vers le controlleur de verification d'access
       return $this->redirectToRoute('app_lookup');
    }

}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/root")
 * @IsGranted("ROLE_ROOT")
 */

class RootController extends AbstractController
{
    #[Route('/', name: 'app_root')]
    public function index(): Response
    {
        return $this->render('root/index.html.twig', [
            'controller_name' => 'RootController',
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Requetes;
use App\Form\RequetesType;
use App\Repository\EtudiantsRepository;
use App\Repository\RequetesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/crud/requetes')]
class CrudRequetesController extends AbstractController
{
    #[Route('/', name: 'app_crud_requetes_index', methods: ['GET'])]
    public function index(RequetesRepository $requetesRepository, EtudiantsRepository $etudiantRepo): Response
    {
        $etudiant = $etudiantRepo->findOneBy(['possesseur'=>$this->getUser()]);
        return $this->render('crud_requetes/index.html.twig', [
            'requetes' => $requetesRepository->findBy(['etudiant'=>$etudiant]),
        ]);
    }

// -----------------------------------------------------------------------------------------

#[Route('/all', name: 'app_crud_requetes_index_all', methods: ['GET'])]
public function request_all(RequetesRepository $requetesRepository, EtudiantsRepository $etudiantRepo): Response
{
    $etudiant = $etudiantRepo->findOneBy(['possesseur'=>$this->getUser()]);
    return $this->render('crud_requetes/index_all.html.twig', [
        'requetes' => $requetesRepository->findBy(['etat'=>'non aboutis','statut'=>'actif']),
    ]);
}

// -------------------------------------------------------------------------------------------

    #[Route('/new', name: 'app_crud_requetes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RequetesRepository $requetesRepository, EtudiantsRepository $etudiantRepo): Response
    {
        $requete = new Requetes();

        $form = $this->createForm(RequetesType::class, $requete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $etudiant = $etudiantRepo->findOneBy(['possesseur'=>$this->getUser()]);
            $requete->setEtudiant($etudiant);
            $requete->setStatut('actif');
            $requete->setEtat('non aboutis');
            $requete->setDateDepot(new \datetime());
            

            $requetesRepository->add($requete);
            return $this->redirectToRoute('app_crud_requetes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_requetes/new.html.twig', [
            'requete' => $requete,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crud_requetes_show', methods: ['GET'])]
    public function show(Requetes $requete): Response
    {
        return $this->render('crud_requetes/show.html.twig', [
            'requete' => $requete,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_crud_requetes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Requetes $requete, RequetesRepository $requetesRepository): Response
    {
        $form = $this->createForm(RequetesType::class, $requete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $requetesRepository->add($requete);
            return $this->redirectToRoute('app_crud_requetes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_requetes/edit.html.twig', [
            'requete' => $requete,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crud_requetes_delete', methods: ['POST'])]
    public function delete(Request $request, Requetes $requete, RequetesRepository $requetesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$requete->getId(), $request->request->get('_token'))) {
            $requetesRepository->remove($requete);
        }

        return $this->redirectToRoute('app_crud_requetes_index', [], Response::HTTP_SEE_OTHER);
    }
}

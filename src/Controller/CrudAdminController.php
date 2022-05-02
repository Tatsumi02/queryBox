<?php

namespace App\Controller;

use App\Entity\Admins;
use App\Repository\UserRepository;
use App\Form\AdminsType;
use App\Repository\AdminsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/root")
 * @IsGranted("ROLE_ROOT")
 */
#[Route('/crud/admin')]
class CrudAdminController extends AbstractController
{
    #[Route('/', name: 'app_crud_admin_index', methods: ['GET'])]
    public function index(AdminsRepository $adminsRepository): Response
    {
        return $this->render('crud_admin/index.html.twig', [
            'admins' => $adminsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_crud_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AdminsRepository $adminsRepository,UserRepository $userRepo): Response
    {
        $admin = new Admins();
        $admin->setCv('indef');
      
        $form = $this->createForm(AdminsType::class, $admin);
        $form->handleRequest($request);

       
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $userRepo->find($admin->getPossesseur()->getId());
            $user->setRoles(['ROLE_ADMIN']);
    
            $adminsRepository->add($admin);
            return $this->redirectToRoute('app_crud_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_admin/new.html.twig', [
            'admin' => $admin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crud_admin_show', methods: ['GET'])]
    public function show(Admins $admin): Response
    {
        return $this->render('crud_admin/show.html.twig', [
            'admin' => $admin,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_crud_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Admins $admin, AdminsRepository $adminsRepository): Response
    {
        $form = $this->createForm(AdminsType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adminsRepository->add($admin);
            return $this->redirectToRoute('app_crud_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_admin/edit.html.twig', [
            'admin' => $admin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crud_admin_delete', methods: ['POST'])]
    public function delete(Request $request, Admins $admin, AdminsRepository $adminsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$admin->getId(), $request->request->get('_token'))) {
            $adminsRepository->remove($admin);
        }

        return $this->redirectToRoute('app_crud_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}

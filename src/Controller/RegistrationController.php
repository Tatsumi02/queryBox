<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setDateCompte(new \DateTime());
            

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/init", name="app_init")
     * ce controller permet d'initialiser un admin
     */
    public function init(UserRepository $userRep,UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager){
        $user = new User();
        $user->setNom("Cleone");
        $user->setPrenom("Kouam");
        $user->setDateCompte(new \DateTime());
        $user->setPassword( $userPasswordHasher->hashPassword(
            $user,
            'mm'
        ));

        $user->setAdresse('indefini');
        $user->setGenre('female');
        $user->setRoles(["ROLE_ROOT"]);
        $user->setMatricule('indefini');
        $user->setEmail('cleone@qbox.com');
        $user->setDateNaissance(new \DateTime());

        $userRep->add($user);

        return $this->redirectToRoute('app_lookup');


    }


}

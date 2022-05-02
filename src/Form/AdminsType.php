<?php

namespace App\Form;

use App\Entity\Admins;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('poste',TextType::class,[
                'attr' => ['class' =>'form-control']
            ])

            ->add('date_debut_fonction')
            ->add('competences',TextType::class,[
                'attr' => ['class' =>'form-control']
            ])

            
            ->add('parcours',TextAreaType::class,[
                'attr' => ['class' =>'form-control']
            ])

            ->add('statut',TextType::class,[
                'attr' => ['class' =>'form-control']
            ])

            ->add('possesseur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admins::class,
        ]);
    }
}

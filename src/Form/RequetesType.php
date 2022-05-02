<?php

namespace App\Form;

use App\Entity\Requetes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequetesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('recu')
            ->add('quitus')
            ->add('objet')
            ->add('description')
            // ->add('etat')
            // ->add('statut')
            // ->add('etudiant')
            ->add('matiere')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Requetes::class,
        ]);
    }
}

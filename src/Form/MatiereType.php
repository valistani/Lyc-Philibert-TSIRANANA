<?php

namespace App\Form;

use App\Entity\Matiere;
use App\Entity\Etudiant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_mat')
           // ->add('etudiants')
           /* ->add('etudiants',EntityType::class,[
                    'class' => Etudiant::class,
                    'choice_label' => 'prenom_e',
                    'multiple' => true
                ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Matiere::class,
            'translation_domain' => 'forms'
        ]);
    }
}

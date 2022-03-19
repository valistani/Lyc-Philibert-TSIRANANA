<?php

namespace App\Form;

use App\Entity\Parain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_p')
            ->add('profession_p')
            ->add('contact_p')
            ->add('nom_m')
            ->add('profession_m')
            ->add('contact_m')
            ->add('addresse_pa')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parain::class,
            'translation_domain' => 'forms'
        ]);
    }
}

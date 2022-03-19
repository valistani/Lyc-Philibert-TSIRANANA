<?php

namespace App\Form;

use App\Entity\EtudiantSearch;
use App\Entity\Parain;
use Doctrine\DBAL\Types\StringType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomS'/*,StringType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ]*/)
            /*->add('prenomS',StringType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prenom(s)'
                ]
            ])*/
            ->add('sexeS'/*,StringType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Sexe'
                ]
            ]*/)
            ->add('nationaliteS'/*,StringType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nationalité'
                ]
            ]*/)
            //->add('parain')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EtudiantSearch::class,
            'method' => 'get',
            'csrf_protection' => false,
            'translation_domain' => 'forms'
        ]);
    }

    public function getBlockPrefix()
    {
        return ''; // TODO: Change the autogenerated stub
    }
}
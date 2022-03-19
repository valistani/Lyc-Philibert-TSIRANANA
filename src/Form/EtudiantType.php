<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Matiere;
use App\Entity\Parain;
use App\Entity\Scolaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_e')
            ->add('prenom_e')
            ->add('date_naissance_e')
            ->add('sexe_e', ChoiceType::class,[
                'choices' => $this->getSexeChoices()
            ])
            ->add('addresse_e')
            /*->add('created_at')*/
            ->add('lieu_naissance_e')
            ->add('nationalite_e', ChoiceType::class,[
                'choices' => $this->getNationnaliteChoices()
            ])
            ->add('phone_e')
            ->add('email_e')
            //->add('parain')
            ->add('parain',EntityType::class,[
                'class' => Parain::class,
                'choice_label' => 'nom_p',
                'multiple' => false
            ])
            ->add('scolaire',EntityType::class,[
                'class' => Scolaire::class,
                'choice_label' => 'annee_scolaire',
                'multiple' => false
            ])
            /*->add('matieres',EntityType::class,[
                'class' => Matiere::class,
                'choice_label' => 'nom_m',
                'multiple' => true
            ])*/
            ->add('imageFile',FileType::class,[
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getSexeChoices()
    {
        $choices = Etudiant::SEXE;
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }

    private function getNationnaliteChoices()
    {
        $choices = Etudiant::NATIONALITE;
        $aff = [];
        foreach ($choices as $q => $r){
            $aff[$r] = $q;
        }
        return $aff;
    }
}

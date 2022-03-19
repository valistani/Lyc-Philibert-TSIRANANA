<?php


namespace App\Form;
use App\Entity\Note;
use App\Entity\Etudiant;
use App\Entity\Matiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note')
            // ->add('etudiants')
             /*->add('etudiant',EntityType::class,[
                     'class' => Etudiant::class,
                     'choice_label' => 'prenom_e',
                     'multiple' => true
                 ])*/
            /*->add('matiere',EntityType::class,[
                'class' => Matiere::class,
                'choice_label' => 'nom_mat',
                'multiple' => true
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
            'translation_domain' => 'forms'
        ]);
    }
}
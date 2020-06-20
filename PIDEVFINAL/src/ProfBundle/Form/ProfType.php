<?php

namespace ProfBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataMapper\CheckboxListMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('email')
            ->add('adresse')
            ->add('specialite', ChoiceType::class,array(
                'choices'=>array(
                    'Francais'=>'Francais',
                    'Anglais'=>'Anglais',
                    'Arabe'=>'Arabe',
                    'Mathématiques'=>'Mathématiques',
                    'Histoire géographie'=>'Histoire géographie',
                    'Sciences de la vie et de la terre'=>'Sciences de la vie et de la terre',
                    'Sciences physiques'=>'Sciences physiques',
                    'Technologie'=>'Technologie',
                    'Musique'=>'Musique',
                )
            ));


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProfBundle\Entity\Prof'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'profbundle_prof';
    }


}

<?php

namespace ProfBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('matiere', ChoiceType::class,array(
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
        ))
            ->add('classe')
            ->add('date')
            ->add('hdep' , ChoiceType::class,array(
                'choices'=>array(
                    '8'=>'8',
                    '9'=>'9',
                    '10'=>'10',
                    '11'=>'11',
                    '12'=>'12',
                    '13'=>'13',
                    '14'=>'14',
                    '15'=>'15',
                    '16'=>'16',
                    '17'=>'17',
                    '18'=>'18',
                )
            ))
            ->add('hfin' , ChoiceType::class,array(
                'choices'=>array(
                    '8'=>'8',
                    '9'=>'9',
                    '10'=>'10',
                    '11'=>'11',
                    '12'=>'12',
                    '13'=>'13',
                    '14'=>'14',
                    '15'=>'15',
                    '16'=>'16',
                    '17'=>'17',
                    '18'=>'18',
                )
            ));


    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProfBundle\Entity\Abs'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'profbundle_abs';
    }


}


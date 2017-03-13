<?php

namespace AppBundle\Form;

use AppBundle\Entity\Commission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use XMLReader;

class CommissionTypeByAdmin extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('state', 'entity', array('class'=> 'AppBundle\Entity\State', 'choice_label'=>'description'))
//            ->add('status', ChoiceType::class, array(
//                'choices'  => array(
//                    '0' => 'Accepted for realization',
//                    '1' => 'In the implementation',
//                    '2' => 'Ready',
//                    '3' => 'Received by a client',
//                ),
//            ))
            ->add('completionTime', DateType::class, array(
                'widget' => 'single_text',
                'input' => 'timestamp',

                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
            ));
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Commission::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_commission';
    }


}

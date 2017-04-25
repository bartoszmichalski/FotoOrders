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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CommissionTypeByAdmin extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('state', EntityType::class , array('class'=> 'AppBundle\Entity\State', 'choice_label'=>'description'))
            ->add('completionTime', DateType::class, array(
                'widget' => 'single_text',
                'input' => 'timestamp',

                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker', 'placeholder'=>'YYYY-MM-DD'],
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

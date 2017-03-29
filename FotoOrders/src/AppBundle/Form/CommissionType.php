<?php

namespace AppBundle\Form;

use AppBundle\Entity\Commission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CommissionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextType::class, array('label' => 'Description: '))
            ->add('filename', FileType::class, array('label' => 'File: '))
            ->add('copies', IntegerType::class, array('label' => 'Copies: '))
            ->add('paper', EntityType::class , array('class'=> 'AppBundle\Entity\Paper', 'choice_label'=>'description', 'label' => 'Paper: '))
            ->add('format', EntityType::class , array('class'=> 'AppBundle\Entity\Format', 'choice_label'=>'description', 'label' => 'Format: '))  
            ->add('shipment', EntityType::class , array('class'=> 'AppBundle\Entity\Shipment', 'choice_label'=>'type', 'label' => 'Shipment: '));  

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

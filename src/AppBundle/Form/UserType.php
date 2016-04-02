<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 02/04/2016
 * Time: 22:03
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('username',TextType::class)
            ->add('save',SubmitType::class)
        ;
    }

    public function setDefaultOption(OptionsResolver $resolver){
        $resolver->setDefaults(array(
           'data_class' => 'AppBundle\Entity\User'
        ));
    }
}
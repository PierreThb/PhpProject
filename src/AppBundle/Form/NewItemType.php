<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 27/04/2016
 * Time: 22:59
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var TYPE_NAME $builder */
        $builder->add('content',TextType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOption(OptionsResolver $resolver)
    {
        /** @var TYPE_NAME $resolver */
        $resolver->setDefaults(array(
           'data_class'=>'AppBundle\Entity\UserRequest'
        ));
    }
}
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

/**
 * Class NewItemType
 * Type to build the form to request to add a new item
 *
 * @package AppBundle\Form
 */
class NewItemType extends AbstractType
{
    /**
     * Function buildForm
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var FormBuilderInterface $builder */
        $builder->add('content',TextType::class);
    }

    /**
     * function setDefaultOptions
     * 
     * @param OptionsResolver $resolver
     */
    public function setDefaultOption(OptionsResolver $resolver)
    {
        /** @var OptionsResolver $resolver */
        $resolver->setDefaults(array(
           'data_class'=>'AppBundle\Entity\UserRequest'
        ));
    }
}
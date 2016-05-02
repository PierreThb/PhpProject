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

/**
 * Class UserType
 * Type to build the form to creates a new User
 * 
 * @package AppBundle\Form
 */
class UserType extends AbstractType
{
    /**
     * Function buildForm
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('username',TextType::class)
        ;
    }

    /**
     * function setDefaultOptions
     * 
     * @param OptionsResolver $resolver
     */
    public function setDefaultOption(OptionsResolver $resolver){
        $resolver->setDefaults(array(
           'data_class' => 'AppBundle\Entity\User'
        ));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 03/04/2016
 * Time: 00:07
 */

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ProjectType
 * Type to build the form to create a new Project
 *
 * @package AppBundle\Form
 */
class ProjectType extends AbstractType
{
    /**
     * Function buildForm
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class)
            ->add('leader',EntityType::class,array(
                'class'=>'AppBundle:User',
                'choice_label'=>'username'
            ))
            ->add('secretary',EntityType::class,array(
                'class'=>'AppBundle:User',
                'choice_label'=>'username'
            ))
            ->add('users',EntityType::class,array(
                'class'=>'AppBundle:User',
                'choice_label'=>'username',
                'multiple'=>true,
                'expanded'=>true
            ))
        ;
    }
}
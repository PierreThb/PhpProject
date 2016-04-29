<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 28/04/2016
 * Time: 20:35
 */

namespace AppBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangeMeetingItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('meeting',EntityType::class,array(
                'choice_label'=>'id',
                'class'=> 'AppBundle\Meeting'
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOption(OptionsResolver $resolver)
    {
        /** @var TYPE_NAME $resolver */
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\Item'
        ));
    }
}
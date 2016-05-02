<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 29/04/2016
 * Time: 13:07
 */

namespace AppBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

/**
 * Class MeetType
 * Type to build the form to create a new Meeting
 * 
 * @package AppBundle\Form
 */
class MeetType extends AbstractType
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
            ->add('date',DateTimeType::class, array(
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'data' => new \DateTime
            ))
            ->add('deadline',DateTimeType::class, array(
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'data' => new \DateTime
            ))
            ->add('room',TextType::class)
            ->add('duration', TimeType::class, array(
                'widget' => 'single_text',
            ))
            ->add('meetingLeader', EntityType::class, array(
                'choice_label' => 'username',
                'class' => 'AppBundle:User'
            ))
            ->add('meetingSecretary', EntityType::class, array(
                'choice_label' => 'username',
                'class' => 'AppBundle:User'
            ))
        ;
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
            'data_class'=>'AppBundle\Entity\Meeting'
        ));
    }
}
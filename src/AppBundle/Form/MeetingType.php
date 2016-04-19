<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 17/04/2016
 * Time: 13:47
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

class MeetingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateTimeType::class, array(
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
}
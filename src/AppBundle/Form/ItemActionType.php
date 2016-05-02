<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 01/05/2016
 * Time: 20:06
 */

namespace AppBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ItemActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',TextType::class)
            ->add('deadline',DateTimeType::class, array(
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'data' => new \DateTime
            ))
        ;
    }
}
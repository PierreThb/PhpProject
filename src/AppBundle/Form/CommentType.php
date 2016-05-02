<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 01/05/2016
 * Time: 19:37
 */

namespace AppBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommentType extends AbstractType
{
     public function buildForm(FormBuilderInterface $builder, array $options)
     {
         $builder->add('content',TextType::class);
     }
}
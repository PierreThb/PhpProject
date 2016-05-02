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

/**
 * Class CommentType
 * Type to build the form to add a comment to a MeetingMinutes
 * 
 * @package AppBundle\Form
 */
class CommentType extends AbstractType
{
    /**
     * Function buildForm
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
     {
         $builder->add('content',TextType::class);
     }
}
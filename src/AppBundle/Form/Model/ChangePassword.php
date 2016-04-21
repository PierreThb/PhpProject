<?php

/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 21/04/2016
 * Time: 17:23
 */

namespace AppBundle\Form\Model;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;

class ChangePassword
{
    /**
     * @SecurityAssert\UserPassword(
     *     message = "Wrong value for your current password"
     * )
     */
    public $oldPassword;

    /**
     * 
     */
    public $newPassword;
}
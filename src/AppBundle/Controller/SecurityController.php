<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 15/03/2016
 * Time: 19:38
 *
 * This file contains the controller for security's actions
 */

namespace AppBundle\Controller;

use AppBundle\Form\Model\ChangePassword;
use AppBundle\Entity\User;
use AppBundle\Form\ChangePasswordType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SecurityController
 * @package AppBundle\Controller
 */
class SecurityController extends Controller
{

    /**
     * Function which manage the login
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/login",name="index")
     */
    public function loginAction(Request $request)
    {
        $User = new User;
        $em = $this->getDoctrine()->getManager();
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('security/login.html.twig', array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    /**
     * Function to change the password of a user
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/changepassword",name="_changepassword")
     */
    public function changeUserPasswordAction(Request $request)
    {
        $user = $this->getUser();
        $changePasswordModel = new ChangePassword();
        $form = $this->createForm(ChangePasswordType::class, $changePasswordModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // perform some action,
            // such as encoding with MessageDigestPasswordEncoder and persist
            return $this->render(':security:changepasswordconfirm.html.twig',array(
                '_username' => $user->getUsername()
            ));
        }

        return $this->render(':security:changepassword.html.twig',array(
            'form' => $form->createView(),
        ));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 02/04/2016
 * Time: 17:35
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    /**
     * @Route("/loginpage",name="_loginpage")
     */
    public function loginPageAction(){
        return $this->render('login/loginpage.html.twig');
    }
}
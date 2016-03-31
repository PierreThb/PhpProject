<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 30/03/2016
 * Time: 16:59
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/welcome",name="welcome")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/welcomePage.html.twig');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 31/03/2016
 * Time: 21:03
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/adminpage",name="_adminpage")
     */
    public function adminPageAction(Request $request)
    {
        return $this->render(':adminpage:adminpage.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/adminpage/newuser",name="_newuser")
     */
    public function newUserAction(Request $request)
    {
        $user = new User();

        $templateName = 'newuser';
        return $this->render($templateName.'.html.twig');
    }

    public function newProjectAction(Request $request)
    {
        $templateName = 'newproject';
        return $this->render($templateName.'.html.twig');
    }

    public function newTeamAction(Request $request)
    {
        $templateName = 'newteam';
        return $this->render($templateName.'.html.twig');
    }
}
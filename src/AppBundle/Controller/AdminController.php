<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 31/03/2016
 * Time: 21:03
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserType;
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

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isValid()){
            $password = $user->getUserName(); //for now password = username
            $user->setPassword($password);
            $user->setIsAdmin(false);
            $user->setTeam(null);

            $em = $this->getDoctrine()->getManager();
            $em ->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'User well stored');

            return $this->redirect($this->generateUrl('_adminpage', array('id'=>$user->getId())));
        }

        return $this->render(':adminpage:newuser.html.twig',array(
            'form' => $form->createView(),
        ));
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
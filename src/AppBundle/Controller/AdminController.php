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
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
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
            $randpass = base64_encode(random_bytes(6));
            $password = $this->get('security.password_encoder')->encodePassword($user, $randpass);
            $user->setPassword($password);
            $user->setIsAdmin(false);
            $user->setTeam(null);

            $em = $this->getDoctrine()->getManager();
            $em ->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'User well stored');

            return $this->render(':adminpage:newuserconfirm.html.twig',array(
                '_username' => $user->getUsername(),
                '_password' => $randpass,
            ));
        }

        return $this->render(':adminpage:newuser.html.twig',array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("adminpage/alluser",name="_alluser")
     */
    public function seeAllUsersAction(Request $request)
    {
        return $this->render(':adminpage:allusers.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("adminpage/newproject",name="_newproject")
     */
    public function newProjectAction(Request $request)
    {
        return $this->render(':adminpage:newproject.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("adminpage/allproject",name="_allproject")
     */
    public function seeAllProjectAction(Request $request)
    {
        return $this->render(':adminpage:allprojects.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("adminpage/newteam",name="_newteam")
     */
    public function newTeamAction(Request $request)
    {
        return $this->render(':adminpage:newteam.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("amdminpage/allteam",name="_allteam")
     */
    public function seeAllTeamsAction(Request $request)
    {
        return $this->render(':adminpage:allteams.html.twig');
    }
}
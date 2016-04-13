<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 31/03/2016
 * Time: 21:03
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Project;
use AppBundle\Entity\User;
use AppBundle\Form\ProjectType;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/adminpage/user", name="_adminuser")
     */
    public function adminUserPartAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $listUser = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();

        return $this->render(':adminpage:adminuser.html.twig',array(
            'listuser'=>$listUser
        ));
    }

    /**
     * @param Request $request
     *
     * @Route("/adminpage/project", name="_adminproject")
     */
    public function adminProjectPartAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $listProject = $this->getDoctrine()->getManager()->getRepository(Project::class)->findAll();

        return $this->render(':adminpage:adminproject.html.twig',array(
            'listproject'=>$listProject
        ));
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
     * @Route("adminpage/newproject",name="_newproject")
     */
    public function newProjectAction(Request $request)
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if($form->isValid()){
            $project->setIslocked(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->render(':adminpage:newprojectconfirm.html.twig',array(
                '_projectname'=>$project->getName()
            ));
        }

        return $this->render(':adminpage:newproject.html.twig',array(
            'form' => $form->createView()
        ));
    }
}
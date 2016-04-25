<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 19/04/2016
 * Time: 15:29
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Meeting;
use AppBundle\Entity\MeetingAttendance;
use AppBundle\Entity\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MeetingController extends Controller
{
    /**
     * @Route("/meetingpage",name="_meeting")
     *
     */
    public function meetingPageAction(Request $request)
    {
        $user = $this->getUser();
        $arrayprj = new ArrayCollection();

        $projects = $this->getDoctrine()->getManager()->getRepository(Project::class)->findAll(); //get all project

        foreach ($projects as $prj){ //browse the array of project
            $participant = $prj->getUsers(); //get all users of the project
            foreach ($participant as $p){ //browse the array of user
                if ($p == $user){ //if equal current user
                    $arrayprj[] = $prj; //add the project to the list of project of the user
                }
            }
        }
        
        return $this->render(':meetingpage:meeting.html.twig',array(
            'prj'=>$arrayprj
        ));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @Route("/meetingpage/{id}",name="_meetingdetails")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function meetingDetailsAction(Request $request, $id)
    {
        return $this->render(':meetingpage:meetingdetails.html.twig',array(
            'message'=>"aucun participant pour l'instant"
        ));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meetingpage/changetoyes/{id}",name="_answeryes")
     */
    public function setAnswerYesAction(Request $request, $id)
    {
        $user = $this->getUser();
        $attendance = $this->getDoctrine()->getManager()->getRepository(MeetingAttendance::class)->findOneBy(array(
            'meeting'=>$id,
            'user'=>$user->getId()
        ));
        
        $attendance->setAnswer("yes");
        $em = $this->getDoctrine()->getManager();
        $em->persist($attendance);
        $em->flush();

        return $this->render(':meetingpage:changeanswerconfirm.html.twig',array(
            'message'=>"Attendance change to yes"
        ));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meetingpage/changetomaybe/{id}",name="_answermaybe")
     */
    public function setAnswerMaybeAction(Request $request, $id)
    {
        $user = $this->getUser();
        $attendance = $this->getDoctrine()->getManager()->getRepository(MeetingAttendance::class)->findOneBy(array(
            'meeting_id'==$id,
            'user_id'==$user->getId()
        ));

        $attendance->setAnswer("maybe");
        $em = $this->getDoctrine()->getManager();
        $em->persist($attendance);
        $em->flush();

        return $this->render(':meetingpage:changeanswerconfirm.html.twig',array(
            'message'=>"attendance change to maybe"
        ));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meetingpage/changetono/{id}",name="_answerno")
     */
    public function setAnswerNoAction(Request $request, $id)
    {
        $user = $this->getUser();
        $attendance = $this->getDoctrine()->getManager()->getRepository(MeetingAttendance::class)->findOneBy(array(
            'meeting_id'==$id,
            'user_id'==$user->getId()
        ));

        $attendance->setAnswer("no");
        $em = $this->getDoctrine()->getManager();
        $em->persist($attendance);
        $em->flush();

        return $this->render(':meetingpage:changeanswerconfirm.html.twig',array(
            'message'=>"attendance change to no"
        ));
    }
}
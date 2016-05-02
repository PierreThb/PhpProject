<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 19/04/2016
 * Time: 15:29
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Item;
use AppBundle\Entity\Meeting;
use AppBundle\Entity\MeetingAgenda;
use AppBundle\Entity\MeetingAttendance;
use AppBundle\Entity\MeetingMinutes;
use AppBundle\Entity\Project;
use AppBundle\Entity\User;
use AppBundle\Entity\UserRequest;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class MeetingController
 * @package AppBundle\Controller
 */
class MeetingController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meetingpage",name="_meeting")
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meetingpage/{id}",name="_meetingdetails")
     */
    public function meetingDetailsAction(Request $request, $id)
    {
        $myUser = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        
        $meeting = $em->getRepository(Meeting::class)->find($id);
        $deadline = $meeting->getDeadline();
        $today = new \DateTime('now');

        $okDeadline = false;

        if($deadline > $today){
            $okDeadline = true;
        }

        $project = $meeting->getProject();
        $leader = $project->getLeader();

        if($leader == $myUser){
            $ok = true;
        }else{
            $ok = false;
        }

        $users = $project->getUsers();
        $agenda = $em->getRepository(MeetingAgenda::class)->findOneBy(array(
           'meeting'=>$meeting
        ));
        $items = $em->getRepository(Item::class)->findBy(
            array('agenda'=>$agenda),
            array('number'=>'ASC')
        );

        $tot = 0;

        foreach ($users as $user){
            $tot = $tot + 1;
        }

        $attendanceYes = $em->getRepository(MeetingAttendance::class)->findBy(array(
            'meeting'=>$id,
            'answer'=>"yes"
        ));

        $totyes = 0;
        foreach ($attendanceYes as $yes){
            $totyes = $totyes +1;
        }

        $percentage = (100*$totyes)/$tot;

        if($percentage == null){
            $message = "No attendance yet";
            $percentage = null;
        }else{
            $message = "";
        }

        $requests = $em->getRepository(UserRequest::class)->findBy(array(
            'agenda'=>$agenda
        ));

        $already = $em->getRepository(MeetingMinutes::class)->findOneBy(array(
           'meeting' => $meeting
        ));

        return $this->render(':meetingpage:meetingdetails.html.twig',array(
            'message'=>$message,
            'percentage'=>$percentage,
            'items'=>$items,
            'meetingId'=>$id,
            'meeting'=>$meeting,
            'requests'=>$requests,
            'ok'=>$ok,
            'okDeadline'=>$okDeadline,
            'today'=>$today,
            'already'=>$already
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

        if($attendance->getAnswer() == "yes"){
            $message = "Attendance already set at yes";
        }else{
            $message = "Attendance change to yes";
            $attendance->setAnswer("yes");
            $em = $this->getDoctrine()->getManager();
            $em->persist($attendance);
            $em->flush();
        }

        return $this->render(':meetingpage:changeanswerconfirm.html.twig',array(
            'message'=>$message
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
            'meeting'==$id,
            'user'==$user->getId()
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
            'meeting'==$id,
            'user'==$user->getId()
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
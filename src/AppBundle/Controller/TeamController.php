<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 12/04/2016
 * Time: 11:36
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use AppBundle\Entity\Meeting;
use AppBundle\Entity\MeetingAgenda;
use AppBundle\Entity\MeetingAttendance;
use AppBundle\Entity\Project;
use AppBundle\Entity\User;
use AppBundle\Form\MeetingType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TeamController extends Controller
{
    /**
     * @Route("/teampage",name="_team")
     */
    public function teamPageAction(Request $request)
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $arrayprj = new ArrayCollection();


        $repository = $this->getDoctrine()->getRepository(Project::class);

        $listp = $repository->findAll(); //get all project

        foreach ($listp as $prj){ //browse the array of project
            $participant = $prj->getUsers(); //get all users or the project
            foreach ($participant as $p){ //browse the array of user
                if ($p == $user){ //if equal our user
                    $arrayprj[] = $prj; //add the project to the list of project of the user
                }
            }
        }

        $listProjetlock = new ArrayCollection();
        $listProjetUnlock = new ArrayCollection();

        foreach ($arrayprj as $pr){
            if ($pr->getIslocked() == true){
                $listProjetlock[] = $pr;
            }else{
                $listProjetUnlock[] = $pr;
            }
        }
            
        return $this->render(':teampage:team.html.twig',array(
            'listprojectunlock'=>$listProjetUnlock,
            'listprojectlock'=>$listProjetlock
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("teampage/newmeeting/{id}",name="_newmeeting")
     */
    public function newMeetingAction(Request $request, $id)
    {
        $user = $this->getUser();
        $username = $user->getUsername();
        $meeting = new Meeting();
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository(Project::class)->find($id);
        $leader = $project->getLeader()->getUsername();

        if($username != $leader){
            return $this->render(':errors:error.html.twig',array(
               'message'=>'Only the leader can add a meeting'
            ));
        }else{
            $form = $this->createForm(MeetingType::class, $meeting);
            $form->handleRequest($request);

            if($form->isValid())
            {
                $listUser = $project->getUsers();

                foreach ($listUser as $us){
                    $attendance = new MeetingAttendance();
                    $attendance->setMeeting($meeting);
                    $attendance->setUser($us);
                    $em->persist($attendance);
                }

                /*
                 * create the first agenda for the meeting
                 */
                $agenda = new MeetingAgenda();
                $agenda->setMeeting($meeting);

                /*
                 * create and set to the agenda the 3 minimum items
                 */
                $item1 = new Item();
                $item1->setAgenda($agenda);
                $item1->setNumber(1);
                $item1->setName("apologies received");
                $item1->setProposer($project->getLeader());
                $item2 = new Item();
                $item2->setAgenda($agenda);
                $item2->setNumber(2);
                $item2->setName("agree agenda");
                $item2->setProposer($project->getLeader());
                $item3 = new Item();
                $item3->setAgenda($agenda);
                $item3->setNumber(3);
                $item3->setName("accept minutes of previous meeting");
                $item3->setProposer($project->getLeader());
                
                $agenda->addItem($item1);
                $agenda->addItem($item2);
                $agenda->addItem($item3);

                $meeting->setProject($project);
                $project->addMeeting($meeting);
                $em->persist($meeting);
                $em->persist($project);
                $em->persist($agenda);
                $em->persist($item1);
                $em->persist($item2);
                $em->persist($item3);
                $em->flush();

                return $this->render(':teampage:newmeetingconfirm.html.twig',array(
                    'date'=>$meeting->getDate(),
                    'project'=>$meeting->getProject()->getName(),
                    'room'=>$meeting->getRoom()
                ));
            }
            return $this->render(':teampage:newmeeting.html.twig',array(
                'form' => $form->createView()
            ));
        }
    }
}
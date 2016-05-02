<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 29/04/2016
 * Time: 21:06
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Item;
use AppBundle\Entity\ItemAction;
use AppBundle\Entity\Meeting;
use AppBundle\Entity\MeetingAgenda;
use AppBundle\Entity\MeetingAttendance;
use AppBundle\Entity\MeetingMinutes;
use AppBundle\Entity\MinuteItem;
use AppBundle\Entity\MinutesComment;
use AppBundle\Entity\Presence;
use AppBundle\Entity\Project;
use AppBundle\Form\CommentType;
use AppBundle\Form\ItemActionType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MeetingMinutesController extends Controller
{


    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meetingpage/publish/{id}",name="_publish")
     */
    public function publishAction(Request $request, $id) //meeting id
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Meeting $meeting
         *  current meeting
         */
        $meeting = $em->getRepository(Meeting::class)->find($id);

        /** @var MeetingMinutes $meetingMinute
         *  new MeetingMinute
         */
        $meetingMinute = new MeetingMinutes();

        /** @var MeetingAgenda $agenda
         *  Agenda of the meeting
         */
        $agenda = $em->getRepository(MeetingAgenda::class)->findOneBy(array(
            'meeting'=>$meeting
        ));

        /** @var Project $project
         *  Project for the current meeting
         */
        $project = $meeting->getProject();

        /** @var ArrayCollection $members
         *  User of the project
         */
        $members = $project->getUsers();

        /** @var ArrayCollection $itemsAgenda */
        $itemsAgenda = $agenda->getItems();

        $meetingMinute->setMeeting($meeting);

        $this->createPresence($members, $meetingMinute);

        $this->createMinuteItems($itemsAgenda);

        $presences = $em->getRepository(Presence::class)->findBy(array(
           'meetingMinute'=>$meetingMinute
        ));

        $listYes = $em->getRepository(MeetingAttendance::class)->findBy(array(
            'meeting'=>$meeting,
            'answer'=>"yes"
        ));

        $usersYes = new ArrayCollection();
        foreach ($listYes as $ye){
            $usersYes[] = $ye->getUser();
        }

        foreach ($presences as $presence){
            if($usersYes->contains($presence->getUser())){
                $presence->setType("present_for_whole_meeting");
                $em->persist($presence);
            };
        }

        $em->persist($meetingMinute);

        $em->flush();

        $comments = null;

        return $this->render(':minutes:meetingminutes.html.twig',array(
            'meeting'=>$meeting,
            'items'=>$itemsAgenda,
            'presences'=>$presences,
            'comments' => $comments
        ));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meetingpage/minutes/{id}",name="_minutes")
     */
    public function seeMinutesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $meeting = $em->getRepository(Meeting::class)->find($id);

        $minutes = $em->getRepository(MeetingMinutes::class)->findOneBy(array(
            'meeting'=>$meeting
        ));

        $presences = $minutes->getPresences();

        /** @var MeetingAgenda $agenda
         *  Agenda of the meeting
         */
        $agenda = $em->getRepository(MeetingAgenda::class)->findOneBy(array(
            'meeting'=>$meeting
        ));

        /** @var ArrayCollection $itemsAgenda */
        $itemsAgenda = $agenda->getItems();

        $comments = $minutes->getComments();

        return $this->render(':minutes:meetingminutes.html.twig',array(
            'meeting'=>$meeting,
            'presences' => $presences,
            'items'=>$itemsAgenda,
            'comments'=>$comments
        ));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meeting/minute/comment/{id}",name="_comment")
     */
    public function minuteCommentAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $meeting = $em->getRepository(Meeting::class)->find($id);
        $minute = $em->getRepository(MeetingMinutes::class)->findOneBy(array(
           'meeting'=>$meeting
        ));

        $comment = new MinutesComment($minute, $this->getUser());

        $form = $this->createForm(CommentType::class,$comment);
        $form->handleRequest($request);

        if($form->isValid()){
            $em->persist($comment);
            $em->flush();

            return $this->render(':minutes:confirmcomment.html.twig',array(
                'meeting'=>$meeting
            ));
        }

        return $this->render(':minutes:comment.html.twig',array(
            'form'=>$form->createView(),
            'meeting'=>$meeting
        ));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meeting/minutes/newaction/{id}",name="_newaction")
     */
    public function addActionItemAction(Request $request, $id) //id de item
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(Item::class)->find($id);
        $minuteItem = $em->getRepository(MinuteItem::class)->findOneBy(array(
           'item'=> $item
        ));

        $agenda = $item->getAgenda();

        $meeting = $agenda->getMeeting();
        
        $itemAction = new ItemAction();

        $form = $this->createForm(ItemActionType::class,$itemAction);
        $form->handleRequest($request);

        if($form->isValid()){
            $itemAction->setItem($minuteItem);
            $itemAction->setImplementer($this->getUser());
            $itemAction->setState("in_progress");

            $em->persist($itemAction);
            $em->flush();

            return $this->render(':actions:actionconfirm.html.twig',array(
                'meeting'=>$meeting
            ));
        }
        return $this->render(':actions:newaction.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @Route("/meeting/minutes/allactions/{id}",name="_allactions")
     */
    public function seeAllActionItemAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $item = $em->getRepository(Item::class)->find($id);
        $minuteItem = $em->getRepository(MinuteItem::class)->findOneBy(array(
            'item'=> $item
        ));
        $agenda = $item->getAgenda();
        $meeting = $agenda->getMeeting();

        $actions = $em->getRepository(ItemAction::class)->findBy(array(
            'item'=>$minuteItem
        ));
        
        return $this->render(':actions:allactions.html.twig',array(
            'actions'=>$actions,
            'meeting'=>$meeting
        ));
    }

    /**
     * @param PersistentCollection $members
     * @param MeetingMinutes $minutes
     */
    private function createPresence(PersistentCollection $members, MeetingMinutes $minutes)
    {
        $em = $this->getDoctrine()->getManager();

        foreach ($members as $member){
            $presence = new Presence($minutes, $member);
            $em->persist($presence);
        }

        $em->flush();
    }

    /**
     * @param PersistentCollection $itemsAgenda
     */
    private function createMinuteItems(PersistentCollection $itemsAgenda)
    {
        $em = $this->getDoctrine()->getManager();

        foreach ($itemsAgenda as $item){
            $minuteItem = new MinuteItem();
            $minuteItem->setItem($item);
            $minuteItem->setPostponed(false);
            $em->persist($minuteItem);
        }

        $em->flush();
    }
}
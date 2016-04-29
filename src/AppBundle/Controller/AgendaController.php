<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 27/04/2016
 * Time: 21:30
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Item;
use AppBundle\Entity\Meeting;
use AppBundle\Entity\MeetingAgenda;
use AppBundle\Entity\User;
use AppBundle\Entity\UserRequest;
use AppBundle\Form\ChangeMeetingItemType;
use AppBundle\Form\ItemType;
use AppBundle\Form\NewItemType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AgendaController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meeting/agenda/requestNew/{id}", name="_newitem")
     */
    public function newItemRequestAction(Request $request, $id)
    {
        $userRequest = new UserRequest();

        $form = $this->createForm(NewItemType::class, $userRequest);
        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();

            /** @var User $user
             *  get current user
             */
            $user = $this->getUser();

            /** @var Meeting $meeting
             *  get current meeting
             */
            $meeting = $em->getRepository(Meeting::class)->find($id);


            /** @var MeetingAgenda $agenda
             *  get agenda for the current meeting
             */
            $agenda = $em->getRepository(MeetingAgenda::class)->findOneBy(array(
                'meeting'=>$meeting
            ));

            $userRequest->setUser($user);
            $userRequest->setAgenda($agenda);
            $userRequest->setType("additional");
            $userRequest->setItem(null);

            $em->persist($userRequest);
            $em->flush();

            return $this->render(':agenda:confirmrequest.html.twig',array(
                'meeting'=>$meeting
            ));
        }

        return $this->render(':agenda:newrequest.html.twig',array(
            'form'=>$form->createView(),
            'message'=>"Enter the title off the new item you want to add to the agenda: "
        ));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meeting/agenda/requestChange/{id}", name="_changeItem")
     */
    public function changeItemRequestAction(Request $request, $id) //item id
    {
        $em = $this->getDoctrine()->getManager();
        $userRequest = new UserRequest();
        $item = $em->getRepository(Item::class)->find($id);
        $agenda = $item->getAgenda();
        $meeting = $agenda->getMeeting();
        $user = $this->getUser();

        $form = $this->createForm(NewItemType::class, $userRequest);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $userRequest->setUser($user);
            $userRequest->setAgenda($agenda);
            $userRequest->setType("changes");
            $userRequest->setItem($item);

            $em->persist($userRequest);
            $em->flush();

            return $this->render(':agenda:confirmrequest.html.twig',array(
                'meeting'=>$meeting
            ));
        }

        return $this->render(':agenda:newrequest.html.twig', array(
            'message'=>"Enter the new title for the item: ",
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/meeting/agenda/requestReOrdering/{id}", name="_orderingItem")
     */
    public function orderingItemRequestAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $userRequest = new UserRequest();
        $item = $em->getRepository(Item::class)->find($id);
        $agenda = $item->getAgenda();
        $meeting = $agenda->getMeeting();
        $items = $agenda->getItems();
        $user = $this->getUser();

        $max = 0;
        foreach ($items as $i){
           $max = $max + 1;
        }

        $form = $this->createForm(NewItemType::class, $userRequest);
        $form->handleRequest($request);

        if($form->isValid()){

            $val = intval($userRequest->getContent());

            if($val >= 4 && $val <= $max){
                $userRequest->setUser($user);
                $userRequest->setAgenda($agenda);
                $userRequest->setType("re-ordering");
                $userRequest->setItem($item);

                $em->persist($userRequest);
                $em->flush();

                return $this->render(':agenda:confirmrequest.html.twig',array(
                    'meeting'=>$meeting
                ));

            }else{
                return $this->render(':errors:error.html.twig',array(
                    'message'=>'the value need to be between 4 and '.$max.'. !',
                    'path'=>'_meetingdetails',
                    'id'=>$meeting->getId()
                ));
            }
        }

        return $this->render(':agenda:newrequest.html.twig', array(
            'message'=>'Enter the new position for the item (between 4 and '.$max.'): ',
            'form' => $form->createView()
        ));
    }

    public function postponeItemRequestAction(Request $request,$id) //item id
    {
        // TODO : formulaire et tous
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("meeting/request/agreed/{id}",name="_agreed")
     */
    public function agreedItemAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $userRequest = $em->getRepository(UserRequest::class)->find($id);
        $userRequest->setState("agreed");

        $agenda = $userRequest->getAgenda();
        $meeting = $agenda->getMeeting();
        $type = $userRequest->getType();

        switch ($type) {
            case "additional":
                $val = 1;

                foreach ($agenda->getItems() as $it) {
                    $val = $val + 1;
                }

                $item = new Item();
                $item->setAgenda($agenda);
                $item->setName($userRequest->getContent());
                $item->setNumber($val);
                $item->setProposer($userRequest->getUser());

                $em->persist($item);
                $em->persist($userRequest);
                $em->flush();

                return $this->render(':agenda:confirmagreed.html.twig', array(
                    'item' => $item,
                    'meeting' => $meeting,
                    'message' => 'Item "' . $item->getName() . '" add to the agenda.'
                ));

            case "changes":

                $item = $userRequest->getItem();
                $item->setName($userRequest->getContent());

                $em->persist($item);
                $em->persist($userRequest);
                $em->flush();

                return $this->render(':agenda:confirmagreed.html.twig',array(
                    'meeting' => $meeting,
                    'message' => 'Item "' . $item->getName() . '" has been changed.'
                ));

            case "re-ordering":

                $val = intval($userRequest->getContent());
                $item = $userRequest->getItem();

                /** @var Item $items
                 *  all items of the agenda
                 */
                $items = $em->getRepository(Item::class)->findBy(array(
                    'agenda'=>$agenda,
                ));

                /** @var Item $listToChange
                 *  items where we need to change the position
                 */
                $listToChange = new ArrayCollection();
                $changeMore = new ArrayCollection();
                if($val < $item->getNumber()){ //if new pos lower than before
                    $operation = "plus";
                    foreach ($items as $i){
                        if($i->getNumber() >= $val && $i->getNumber() < $item->getNumber()){
                            $listToChange[] = $i;
                        }
                    }
                }else{ // if new pos higher than before
                    $operation = "minus";
                    foreach ($items as $i){
                        if($i->getNumber() <= $val && $i->getNumber() > $item->getNumber()){
                            $listToChange[] = $i;
                        }
                    }
                }

                if($operation == "plus"){
                    foreach ($listToChange as $itt){
                        $nb = $itt->getNumber();
                        $itt->setNumber($nb+1);
                        $em->persist($itt);
                    }
                }else{
                    foreach ($listToChange as $itt){
                        $nb = $itt->getNumber();
                        $itt->setNumber($nb-1);
                        $em->persist($itt);
                    }
                }

                $item->setNumber($val);

                $em->flush();

                return $this->render(':agenda:confirmagreed.html.twig',array(
                    'meeting' => $meeting,
                    'message' => 'Position of item "' . $item->getName() . '" has been changed.'
                ));
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("meeting/request/noted/{id}",name="_noted")
     */
    public function notedItemAction(Request $request, $id) //id de request
    {
        $em = $this->getDoctrine()->getManager();
        $userRequest = $em->getRepository(UserRequest::class)->find($id);
        $agenda = $userRequest->getAgenda();
        $meeting = $agenda->getMeeting();

        $userRequest->setState("noted");
        $em->persist($userRequest);
        $em->flush();

        return $this->render(':agenda:confirmnoted.html.twig',array(
            'meeting'=>$meeting,
            'message'=>'Request state has changed to "noted".'
        ));
    }
}
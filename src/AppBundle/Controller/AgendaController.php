<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 27/04/2016
 * Time: 21:30
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Meeting;
use AppBundle\Entity\MeetingAgenda;
use AppBundle\Entity\UserRequest;
use AppBundle\Form\NewItemType;
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
     * @Route("/meeting/agenda/request/{id}", name="_newitem")
     */
    public function newItemAction(Request $request, $id)
    {
        $userRequest = new UserRequest();

        $form = $this->createForm(NewItemType::class, $userRequest);
        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();

            /** @var TYPE_NAME $user
             *  get current user
             */
            $user = $this->getUser();

            /** @var TYPE_NAME $meeting
             *  get current meeting
             */
            $meeting = $em->getRepository(Meeting::class)->find($id);


            /** @var TYPE_NAME $agenda
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
            'form'=>$form->createView()
        ));
    }
}
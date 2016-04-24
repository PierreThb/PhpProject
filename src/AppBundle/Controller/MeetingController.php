<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 19/04/2016
 * Time: 15:29
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Meeting;
use AppBundle\Entity\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MeetingController extends Controller
{
    /**
     * @Route("/meetingpage",name="_meeting")
     */
    public function meetingPageAction(Request $request)
    {
        $user = $this->getUser();
        $arrayprj = new ArrayCollection();

        $repository = $this->getDoctrine()->getRepository(Project::class);

        $listp = $repository->findAll(); //get all project

        foreach ($listp as $prj){ //browse the array of project
            $participant = $prj->getUsers(); //get all users of the project
            foreach ($participant as $p){ //browse the array of user
                if ($p == $user){ //if equal our user
                    $arrayprj[] = $prj; //add the project to the list of project of the user
                }
            }
        }

        $listmeeting = new ArrayCollection();
        foreach ($arrayprj as $prj){ //browse the array of project
            $meeting = $this->getDoctrine()->getRepository(Meeting::class);
        }

        return $this->render(':meetingpage:meeting.html.twig');
    }
}
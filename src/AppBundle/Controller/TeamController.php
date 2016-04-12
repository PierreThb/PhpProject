<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 12/04/2016
 * Time: 11:36
 */

namespace AppBundle\Controller;


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
        return $this->render(':teampage:team.html.twig');
    }
}
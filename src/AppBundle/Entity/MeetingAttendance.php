<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 24/04/2016
 * Time: 21:12
 *
 * This file contains the MeetingAttendance entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Time;

/**
 * Each meeting has a MeetingAttendance
 * for each member of the team.
 * A MeetingAttendance is defined by the related meeting,
 * a user and his answer.
 *
 * @ORM\Table(name="meetingAttendance")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeetingAttendanceRepository")
 */
class MeetingAttendance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Meeting
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Meeting")
     * @ORM\JoinColumn(name="meetingId", referencedColumnName="id")
     */
    private $meeting;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $user;

    /**
     * Possible value are:
     * - "yes"
     * - "no"
     * - "maybe"
     * - the default one is "notanswer"
     *
     * @var string
     *
     * @ORM\Column(name="userAnswer",type="string")
     */
    private $answer;

    public function __construct()
    {
        $this->answer = "notanswer";
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set meeting
     *
     * @param \AppBundle\Entity\Meeting $meeting
     *
     * @return MeetingAttendance
     */
    public function setMeeting(\AppBundle\Entity\Meeting $meeting = null)
    {
        $this->meeting = $meeting;

        return $this;
    }

    /**
     * Get meeting
     *
     * @return \AppBundle\Entity\Meeting
     */
    public function getMeeting()
    {
        return $this->meeting;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return MeetingAttendance
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * 0 = not answerded yet
     * 1 = maybe
     * 2 = no
     * 3 = yes
     *
     * @param $answer
     */
    public function setAnswer($answer)
    {
        //if($this->answer === null || $this->answer === "notanswer" || $this->answer === "maybe" || $this->answer === "no"){
            $this->answer = $answer;
        //};
    }

    /**
     * Get answer
     *
     * @return int
     */
    public function getAnswer()
    {
      return $this->answer;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Time;

/**
 * Meeting
 *
 * @ORM\Table(name="meeting")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeetingRepository")
 */
class Meeting
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
     * @var int
     *
     * @ORM\Column(name="duration",type="time")
     */
    private $duration;

    /**
     * @var date
     *
     * @ORM\Column(name="date",type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="room",type="string")
     */
    private $room;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $meetingLeader;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $meetingSecretary;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Project",inversedBy="meetings")
     * @ORM\JoinColumn(name="ProjectMeetings", referencedColumnName="id")
     */
    private $project;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Meeting
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Meeting
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Meeting
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set deadlineAgenda
     *
     * @param \DateTime $deadlineAgenda
     *
     * @return Meeting
     */
    public function setDeadlineAgenda($deadlineAgenda)
    {
        $this->deadlineAgenda = $deadlineAgenda;

        return $this;
    }

    /**
     * Get deadlineAgenda
     *
     * @return \DateTime
     */
    public function getDeadlineAgenda()
    {
        return $this->deadlineAgenda;
    }

    /**
     * Set room
     *
     * @param string $room
     *
     * @return Meeting
     */
    public function setRoom($room)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return string
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set meetingAgenda
     *
     * @param \AppBundle\Entity\MeetingAgenda $meetingAgenda
     *
     * @return Meeting
     */
    public function setMeetingAgenda(\AppBundle\Entity\MeetingAgenda $meetingAgenda = null)
    {
        $this->meetingAgenda = $meetingAgenda;

        return $this;
    }

    /**
     * Get meetingAgenda
     *
     * @return \AppBundle\Entity\MeetingAgenda
     */
    public function getMeetingAgenda()
    {
        return $this->meetingAgenda;
    }

    /**
     * Set meetingLeader
     *
     * @param \AppBundle\Entity\User $meetingLeader
     *
     * @return Meeting
     */
    public function setMeetingLeader(\AppBundle\Entity\User $meetingLeader = null)
    {
        $this->meetingLeader = $meetingLeader;

        return $this;
    }

    /**
     * Get meetingLeader
     *
     * @return \AppBundle\Entity\User
     */
    public function getMeetingLeader()
    {
        return $this->meetingLeader;
    }

    /**
     * Set meetingSecretary
     *
     * @param \AppBundle\Entity\User $meetingSecretary
     *
     * @return Meeting
     */
    public function setMeetingSecretary(\AppBundle\Entity\User $meetingSecretary = null)
    {
        $this->meetingSecretary = $meetingSecretary;

        return $this;
    }

    /**
     * Get meetingSecretary
     *
     * @return \AppBundle\Entity\User
     */
    public function getMeetingSecretary()
    {
        return $this->meetingSecretary;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Meeting
     */
    public function setProject(\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }
}

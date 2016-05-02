<?php
/**
 * This file contains the Meeting entity
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Time;

/**
 * A Meeting is related to a Project. Each Project
 * can have several Meeting.
 * A Meeting is defined by a duration,
 * a date, a room, the a meeting chair (leader),
 * a meeting secretary, the related project and a
 * deadline.
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
     * @var time
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
     * @var date
     *
     * @ORM\Column(name="deadline",type="datetime")
     */
    private $deadline;

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

    /**
     * Set deadline
     *
     * @param \DateTime $deadline
     *
     * @return Meeting
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get deadline
     *
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 29/04/2016
 * Time: 18:52
 *
 * This file contains the MeetingMinutes entity
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Each meeting, when his deadline is crossed,
 * has a MeetingMinutes which is defined by the related
 * meeting, a set of Presence, a set of comments and a set
 * of minuteItem.
 *
 * @ORM\Table(name="meeting_minutes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeetingMinutesRepository")
 */
class MeetingMinutes
{
    /**
     * Id of the MeetingMinutes
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Meeting related to the MeetingMinutes
     *
     * @var Meeting
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Meeting")
     * @ORM\JoinColumn(name="meeting_id",referencedColumnName="id")
     */
    private $meeting;

    /**
     * Array containing all Presence for the MeetingMinutes
     *
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Presence",mappedBy="meetingMinute")
     */
    private $presences;

    /**
     * Array containing all Comment for the MeetingMinutes
     *
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MinutesComment",mappedBy="meetingMinute")
     */
    private $comments;

    /**
     * Array containing all MinuteItem for the MeetingMinutes
     * 
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MinuteItem",mappedBy="meetingMinute")
     */
    private $minuteItems;

    /**
     * MeetingMinutes constructor.
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->minuteItems = new ArrayCollection();
        $this->presences = new ArrayCollection();
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
     * Add presence
     *
     * @param \AppBundle\Entity\Presence $presence
     *
     * @return MeetingMinutes
     */
    public function addPresence(\AppBundle\Entity\Presence $presence)
    {
        $this->presences[] = $presence;

        return $this;
    }

    /**
     * Remove presence
     *
     * @param \AppBundle\Entity\Presence $presence
     */
    public function removePresence(\AppBundle\Entity\Presence $presence)
    {
        $this->presences->removeElement($presence);
    }

    /**
     * Get presences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPresences()
    {
        return $this->presences;
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\MinutesComment $comment
     *
     * @return MeetingMinutes
     */
    public function addComment(\AppBundle\Entity\MinutesComment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\MinutesComment $comment
     */
    public function removeComment(\AppBundle\Entity\MinutesComment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add minuteItem
     *
     * @param \AppBundle\Entity\MinuteItem $minuteItem
     *
     * @return MeetingMinutes
     */
    public function addMinuteItem(\AppBundle\Entity\MinuteItem $minuteItem)
    {
        $this->minuteItems[] = $minuteItem;

        return $this;
    }

    /**
     * Remove minuteItem
     *
     * @param \AppBundle\Entity\MinuteItem $minuteItem
     */
    public function removeMinuteItem(\AppBundle\Entity\MinuteItem $minuteItem)
    {
        $this->minuteItems->removeElement($minuteItem);
    }

    /**
     * Get minuteItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMinuteItems()
    {
        return $this->minuteItems;
    }

    /**
     * Set meeting
     *
     * @param \AppBundle\Entity\Meeting $meeting
     *
     * @return MeetingMinutes
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
}

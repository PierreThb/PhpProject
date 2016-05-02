<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 29/04/2016
 * Time: 19:16
 *
 * This file contains the Presence entity
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\MeetingMinutes;
use AppBundle\Entity\User;

/**
 * Each member of the team has a Presence
 * object for each meeting. It is defined by
 * the related user, the related MeetingMinute
 * and the string type which describe the Presence.
 *
 * @ORM\Table(name="presence")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PresenceRepository")
 */
class Presence
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    private $user;

    /**
     * Possible values are:
     * - "present_whole_meeting"
     * - "late"
     * - "left_early"
     * - "late_and_left_early"
     * - "absent_no_apologies"
     * - "absent_apologies_before"
     * - "absent_apologies_after"
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @var MeetingMinutes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MeetingMinutes",inversedBy="presences",cascade={"persist"})
     * @ORM\JoinColumn(name="meeting_id",referencedColumnName="id")
     */
    private $meetingMinute;


    /**
     * Presence constructor.
     * @param MeetingMinutes|null $minute
     * @param User|null $user
     */
    public function __construct(MeetingMinutes $minute = null, User $user = null)
    {
        $this->meetingMinute = $minute;
        $this->user = $user;
        $this->type = "absent_no_apologies";
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
     * Set type
     *
     * @param string $type
     *
     * @return Presence
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Presence
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
     * Set meetingMinute
     *
     * @param \AppBundle\Entity\MeetingMinutes $meetingMinute
     *
     * @return Presence
     */
    public function setMeetingMinute(\AppBundle\Entity\MeetingMinutes $meetingMinute = null)
    {
        $this->meetingMinute = $meetingMinute;

        return $this;
    }

    /**
     * Get meetingMinute
     *
     * @return \AppBundle\Entity\MeetingMinutes
     */
    public function getMeetingMinute()
    {
        return $this->meetingMinute;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 29/04/2016
 * Time: 19:06
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\MeetingMinutes;
use AppBundle\Entity\User;
/**
 * MinutesComment
 *
 * @ORM\Table(name="minutes_comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MinutesCommentRepository")
 */
class MinutesComment
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
     * @var MeetingMinutes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MeetingMinutes",inversedBy="comments")
     * @ORM\JoinColumn(name="meeting_minute_id",referencedColumnName="id")
     */
    private $meetingMinute;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * MinutesComment constructor.
     * @param \AppBundle\Entity\MeetingMinutes|null $minute
     * @param \AppBundle\Entity\User|null $user
     */
    public function __construct(MeetingMinutes $minute = null, User $user = null)
    {
        $this->meetingMinute = $minute;
        $this->user = $user;
        $this->content = "";
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
     * Set content
     *
     * @param string $content
     *
     * @return MinutesComment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return MinutesComment
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
     * @return MinutesComment
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

<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 29/04/2016
 * Time: 19:13
 *
 * This file contains the MinuteItem entity
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Item;
use AppBundle\Entity\ItemAction;
use Doctrine\ORM\Mapping as ORM;
/**
 * Each MeetingMinute contains at least
 * three MinuteItem which are defined by
 * an item, the related MeetingMinute,
 * an action, a comment and a postponed
 * boolean.
 *
 * @ORM\Table(name="minute_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MinuteItemRepository")
 *
 */
class MinuteItem
{
    /**
     * Id of the MinuteItem
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Item related to MinuteItem
     *
     * @var Item
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Item")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $item;

    /**
     * MeetingMinute related to the MinuteItem
     *
     * @var MeetingMinutes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MeetingMinutes",inversedBy="minuteItems")
     * @ORM\JoinColumn(name="meeting_minute_id",referencedColumnName="id")
     */
    //private $meetingMinute;

    /**
     * Action for the MinuteItem
     *
     * @var ItemAction
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ItemAction",mappedBy="item")
     */
    private $action;

    /**
     * Boolean which say if the MinuteItem is postponed or not
     *
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $postponed;

    /**
     * Comment of the MinuteItem
     * 
     * @var string
     *
     * @ORM\Column(type="text",nullable=true)
     */
    private $comment;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->action = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set postponed
     *
     * @param boolean $postponed
     *
     * @return MinuteItem
     */
    public function setPostponed($postponed)
    {
        $this->postponed = $postponed;

        return $this;
    }

    /**
     * Get postponed
     *
     * @return boolean
     */
    public function getPostponed()
    {
        return $this->postponed;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return MinuteItem
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set item
     *
     * @param \AppBundle\Entity\Item $item
     *
     * @return MinuteItem
     */
    public function setItem(\AppBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \AppBundle\Entity\Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Add action
     *
     * @param \AppBundle\Entity\ItemAction $action
     *
     * @return MinuteItem
     */
    public function addAction(\AppBundle\Entity\ItemAction $action)
    {
        $this->action[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param \AppBundle\Entity\ItemAction $action
     */
    public function removeAction(\AppBundle\Entity\ItemAction $action)
    {
        $this->action->removeElement($action);
    }

    /**
     * Get action
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAction()
    {
        return $this->action;
    }
}

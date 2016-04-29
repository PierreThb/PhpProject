<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 29/04/2016
 * Time: 19:13
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Item;
use AppBundle\Entity\ItemAction;
use Doctrine\ORM\Mapping as ORM;
/**
 * MinuteItem
 *
 * @ORM\Table(name="minute_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MinuteItemRepository")
 *
 */
class MinuteItem
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
     * @var Item
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Item")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $item;

    /**
     * @var ItemAction
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ItemAction",mappedBy="item")
     */
    private $action;

    /**
     * @var boolean
     *
     *  @ORM\Column(type="boolean")
     */
    private $postponed;

    /**
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

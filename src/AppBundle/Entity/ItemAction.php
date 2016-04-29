<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 29/04/2016
 * Time: 19:19
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;
use AppBundle\Entity\MinuteItem;

/**
 * ItemAction
 *
 * @ORM\Table(name="item_action")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemActionRepository")
 */
class ItemAction
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
     * @var MinuteItem
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MinuteItem",inversedBy="action")
     * @ORM\JoinColumn(name="item_id",referencedColumnName="id")
     */
    private $item;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $state;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="implementer_id",referencedColumnName="id")
     */
    private $implementer;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $deadline;

    /**
     * ItemAction constructor.
     */
    public function __construct()
    {
        $this->state = "in_progress";
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
     * Set state
     *
     * @param string $state
     *
     * @return ItemAction
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ItemAction
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set deadline
     *
     * @param \DateTime $deadline
     *
     * @return ItemAction
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

    /**
     * Set item
     *
     * @param \AppBundle\Entity\MinuteItem $item
     *
     * @return ItemAction
     */
    public function setItem(\AppBundle\Entity\MinuteItem $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \AppBundle\Entity\MinuteItem
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set implementer
     *
     * @param \AppBundle\Entity\User $implementer
     *
     * @return ItemAction
     */
    public function setImplementer(\AppBundle\Entity\User $implementer = null)
    {
        $this->implementer = $implementer;

        return $this;
    }

    /**
     * Get implementer
     *
     * @return \AppBundle\Entity\User
     */
    public function getImplementer()
    {
        return $this->implementer;
    }
}

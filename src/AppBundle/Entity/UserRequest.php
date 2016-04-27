<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 27/04/2016
 * Time: 21:32
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRequest
 *
 * @ORM\Table(name="userRequest")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRequestRepository")
 */
class UserRequest
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
     * @var MeetingAgenda
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MeetingAgenda")
     * @ORM\JoinColumn(name="agenda_id",referencedColumnName="id")
     *
     */
    private $agenda;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     *
     */
    private $user;

    /**
     * @var Item
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Item")
     * @ORM\JoinColumn(nullable=true,name="item_id",referencedColumnName="id")
     *
     */
    private $item;

    /**
     * Type has three different possible value:
     * - "additional" : if a user ask to add a new item
     * - "changes" : if a user ask to do a change on an item
     * - "postponing" : if a user want to postpone an item to an other meeting
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * State has
     * - "pending" : the request does not has been saw by the meeting chair yet
     * - "noted" : the request has been saw by the meeting chair
     * - "agreed" : the request has been agreed and the item add or update depending of the request type
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $content;

    public function __construct()
    {
        $this->state = "pending";
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
     * @return UserRequest
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
     * Set state
     *
     * @param string $state
     *
     * @return UserRequest
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
     * Set content
     *
     * @param string $content
     *
     * @return UserRequest
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
     * Set agenda
     *
     * @param \AppBundle\Entity\MeetingAgenda $agenda
     *
     * @return UserRequest
     */
    public function setAgenda(MeetingAgenda $agenda = null)
    {
        $this->agenda = $agenda;

        return $this;
    }

    /**
     * Get agenda
     *
     * @return \AppBundle\Entity\MeetingAgenda
     */
    public function getAgenda()
    {
        return $this->agenda;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserRequest
     */
    public function setUser(User $user = null)
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
     * Set item
     *
     * @param \AppBundle\Entity\Item $item
     *
     * @return UserRequest
     */
    public function setItem(Item $item = null)
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
}

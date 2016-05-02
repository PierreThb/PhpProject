<?php
/**
 * Created by PhpStorm.
 * User: Pierre
 * Date: 26/04/2016
 * Time: 22:27
 *
 * This file contain the entity Item
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item is related to an agenda,
 * has a name, a proposer and a number
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemRepository")
 */
class Item
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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var MeetingAgenda
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MeetingAgenda",inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agenda;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="proposer_id",referencedColumnName="id")
     */
    private $proposer;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $number;

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
     * Set name
     *
     * @param string $name
     *
     * @return Item
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Item
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set agenda
     *
     * @param \AppBundle\Entity\MeetingAgenda $agenda
     *
     * @return Item
     */
    public function setAgenda(\AppBundle\Entity\MeetingAgenda $agenda)
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
     * Set proposer
     *
     * @param \AppBundle\Entity\User $proposer
     *
     * @return Item
     */
    public function setProposer(\AppBundle\Entity\User $proposer = null)
    {
        $this->proposer = $proposer;

        return $this;
    }

    /**
     * Get proposer
     *
     * @return \AppBundle\Entity\User
     */
    public function getProposer()
    {
        return $this->proposer;
    }
}

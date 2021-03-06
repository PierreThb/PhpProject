<?php

/**
 * This file contains the Project entity
 */
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * The admin can create Project. Each project
 * is defined by a name, a leader, a secretary,
 * a set of users, a boolean to lock and unlock the project
 * and a set of meetings (is null when the project is created)
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * Id of the Project
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Nmae of the Project
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * Leader of the Project
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $leader;

    /**
     * Secretary of the Project
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $secretary;

    /**
     * Boolean to say if the Project is locked or not
     *
     * @ORM\Column(type="boolean")
     */
    private $islocked;

    /**
     * User who belongs to the Project
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User")
     */
    private $users;

    /**
     * Meeting who belongs to the Project
     * 
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Meeting",mappedBy="project")
     */
    private $meetings;

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->meetings = new ArrayCollection();
    }

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
     * @return Project
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
     * Set leader
     *
     * @param \AppBundle\Entity\User $leader
     *
     * @return Project
     */
    public function setLeader(\AppBundle\Entity\User $leader = null)
    {
        $this->leader = $leader;

        return $this;
    }

    /**
     * Get leader
     *
     * @return \AppBundle\Entity\User
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * Set secretary
     *
     * @param \AppBundle\Entity\User $secretary
     *
     * @return Project
     */
    public function setSecretary(\AppBundle\Entity\User $secretary = null)
    {
        $this->secretary = $secretary;

        return $this;
    }

    /**
     * Get secretary
     *
     * @return \AppBundle\Entity\User
     */
    public function getSecretary()
    {
        return $this->secretary;
    }

    /**
     * Set islocked
     *
     * @param boolean $islocked
     *
     * @return Project
     */
    public function setIslocked($islocked)
    {
        $this->islocked = $islocked;

        return $this;
    }

    /**
     * Get islocked
     *
     * @return boolean
     */
    public function getIslocked()
    {
        return $this->islocked;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Project
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add meeting
     *
     * @param \AppBundle\Entity\Meeting $meeting
     *
     * @return Project
     */
    public function addMeeting(\AppBundle\Entity\Meeting $meeting)
    {
        $this->meetings[] = $meeting;

        return $this;
    }

    /**
     * Remove meeting
     *
     * @param \AppBundle\Entity\Meeting $meeting
     */
    public function removeMeeting(\AppBundle\Entity\Meeting $meeting)
    {
        $this->meetings->removeElement($meeting);
    }

    /**
     * Get meetings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeetings()
    {
        return $this->meetings;
    }
}

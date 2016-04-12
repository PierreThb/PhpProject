<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $leader;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $secretary;

    /**
     * @ORM\Column(type="boolean")
     */
    private $islocked;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
}

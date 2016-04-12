<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /*
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="numberMember", type="integer")
     */
    private $numbermember;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Project")
     */
    private $project;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     */
    private $leader;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     */
    private $secretary;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Meeting")
     */
    private $nextmeeting;


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
     * Set numberMember
     *
     * @param integer $numberMember
     *
     * @return Team
     */
    public function setNumberMember($numberMember)
    {
        $this->numbermember = $numberMember;

        return $this;
    }

    /**
     * Get numberMember
     *
     * @return int
     */
    public function getNumberMember()
    {
        return $this->numbermember;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Team
     */
    public function setProject(\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set leader
     *
     * @param \AppBundle\Entity\User $leader
     *
     * @return Team
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
     * @return Team
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
     * Set nextMeeting
     *
     * @param \AppBundle\Entity\Meeting $nextMeeting
     *
     * @return Team
     */
    public function setNextMeeting(\AppBundle\Entity\Meeting $nextMeeting = null)
    {
        $this->nextmeeting = $nextMeeting;

        return $this;
    }

    /**
     * Get nextMeeting
     *
     * @return \AppBundle\Entity\Meeting
     */
    public function getNextMeeting()
    {
        return $this->nextmeeting;
    }
}

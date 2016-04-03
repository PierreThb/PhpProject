<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(name="userName", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var Team
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Team")
     */
    private $team;

    /**
     * @var bool
     *
     * @ORM\Column(name="isAdmin", type="boolean")
     */
    private $isadmin;


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
     * Set username
     *
     * @param string $userName
     *
     * @return User
     */
    public function setUserName($userName)
    {
        $this->username = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set isAdmin
     *
     * @param boolean $isAdmin
     *
     * @return User
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isadmin = $isAdmin;

        return $this;
    }

    /**
     * Get isadmin
     *
     * @return bool
     */
    public function getIsAdmin()
    {
        return $this->isadmin;
    }

    /**
     * Set team
     *
     * @param \AppBundle\Entity\team $team
     *
     * @return User
     */
    public function setTeam(\AppBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \AppBundle\Entity\team
     */
    public function getTeam()
    {
        return $this->team;
    }

    public function getSerializeInfo(){
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isadmin,
            $this->team
        ));
    }
}

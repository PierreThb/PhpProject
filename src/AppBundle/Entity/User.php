<?php
/**
 * This file contains the User entity
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * The admin can create User. Each user is defined
 * by a name, has a password (crypt) and a boolean
 * to be or not an admin user.
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * Id of the User
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Name of the User
     *
     * @var string
     *
     * @ORM\Column(name="userName", type="string", length=255)
     */
    private $username;

    /**
     * Password of the User
     *
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * Boolean to say of the user is admin or not
     * 
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
    public function setUsername($userName)
    {
        $this->username = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUsername()
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
     * Function getSalt()
     *
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Function eraseCredentials()
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * Function getRoles()
     * 
     * @return array
     */
    public function getRoles()
    {
        $array = array('ROLE_USER');
        if ($this->getIsAdmin() == true){
            $array[]='ROLE_ADMIN';
        }
        return $array;
    }
}

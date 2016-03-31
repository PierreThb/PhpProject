<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MeetingAgenda
 *
 * @ORM\Table(name="meeting_agenda")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeetingAgendaRepository")
 */
class MeetingAgenda
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
